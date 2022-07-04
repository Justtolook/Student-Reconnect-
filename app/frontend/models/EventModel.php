<?php
require_once 'Model.php';
require_once 'app/frontend/models/EventSignOnModel.php';

class EventModel extends Model {
    public int $id_event;
    public string $name = "";
    public string $description = "";
    public string $location = "";
    public string $location_rough = "";
    public int $id_userCreator;
    public string $eventDate;
    public string $createdTimestamp;
    public int $numberAttendees = 0;
    public array $signOns = [];


    public function rules(): array {
        return [
            'name' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED],
            'location' => [self::RULE_REQUIRED],
            'location_rough' => [self::RULE_REQUIRED],
            'eventDate' => [self::RULE_REQUIRED],
            'numberAttendees' => [self::RULE_REQUIRED]
        ];
    }

    public function save() : bool {
        $db = new Database();
        $statement = $db->prepare('UPDATE event SET name = :name, description = :description, location = :location, location_rough = :location_rough, eventDate = :eventDate, id_userCreator = :id_userCreator, createdTimestamp = :createdTimestamp, numberAttendees = :numberAttendees WHERE id_event = :id_event');
        $statement->bindValue(':id_event', $this->id_event);
        $statement->bindValue(':name', $this->name);
        $statement->bindValue(':description', $this->description);
        $statement->bindValue(':location', $this->location);
        $statement->bindValue(':id_userCreator', $this->id_userCreator);
        $statement->bindValue(':location_rough', $this->location_rough);
        $statement->bindValue(':eventDate', $this->eventDate);
        $statement->bindValue(':createdTimestamp', $this->createdTimestamp);
        $statement->bindValue(':numberAttendees', $this->numberAttendees);

        return $statement->execute();
    }

    public function delete() {
        $db = new Database();
        $statement = $db->prepare('DELETE FROM event WHERE id_event = :id_event');
        $statement->bindValue(':id_event', $this->id_event);
        $statement->execute();
        $this->deleteSignOns();
    }

    public function fetchAndSetSignOns() : void {
        $db = new Database();
        $statement = $db->prepare('SELECT * FROM eventSignOn WHERE id_Event = :id_event');
        $statement->bindValue(':id_event', $this->id_event);
        $statement->execute();
        foreach ($statement->fetchAll() as $signOn) {
            $signOnModel = new EventSignOnModel();
            $signOnModel->loadData($signOn);
            $this->signOns[] = $signOnModel;
        }
    }

    /**
     * delete all signons for an event
     */
    public function deleteSignOns() : void {
        $db = new Database();
        $statement = $db->prepare('DELETE FROM eventSignOn WHERE id_Event = :id_event');
        $statement->bindValue(':id_event', $this->id_event);
        $statement->execute();
    }

    public function countSignOns() : int {
        return count($this->signOns);
    }

    public function countSignOnsAccepted() : int {
        $count = 0;
        foreach ($this->signOns as $signOn) {
            if ($signOn->accepted) {
                $count++;
            }
        }
        return $count;
    }

    public function getSignOn($uid) {
        foreach($this->signOns as $signOn) {
            if($signOn->id_User == $uid) {
                return $signOn;
            }
        }
        return false;
    }

    public function deleteSignOn($uid) {
        $signOn = $this->getSignOn($uid);
        //remove the signon from the signOns array
        $key = array_search($signOn, $this->signOns);
        unset($this->signOns[$key]);
        $signOn->delete();
    }

    public function toggleSignOn($uid) {
        foreach ($this->signOns as $signOn) {
            //var_dump($signOn);
            if ($signOn->id_User == $uid) {
                $this->deleteSignOn($uid);
                return;
            }
        }
        $signOnModel = new EventSignOnModel();
        $signOnModel->id_Event = $this->id_event;
        $signOnModel->id_User = $uid;
        $signOnModel->save();

    }

    public function getSignOnStatus($uid) {
        $signOn = $this->getSignOn($uid);
        if($signOn) {
            return 1;
        }
        return 0;
    }

    public function getIDUserCreator() {
        return $this->id_userCreator;
    }


}