<?php
require_once 'Model.php';

class EventSignOnModel extends Model {
    public int $id_Event;
    public int $id_User;
    public string $signOnDate = "";
    public int $ratingHost = 0;
    public int $ratingAttendee = 0;
    public int $accepted = 0;

    public function __construct() {
        $this->signOnDate = date("Y-m-d H:i:s");
    }

    public function rules(): array {
        return [];
    }

    public function getSignOnsByEventId($id_event): array {
        $db = new Database();
        $statement = $db->prepare('SELECT * FROM eventSignOn WHERE id_Event = :id_event');
        $statement->bindValue(':id_event', $id_event);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getSignOnIdsByEventId($id_event): array {
        $db = new Database();
        $statement = $db->prepare('SELECT id_User FROM eventSignOn WHERE id_Event = :id_event');
        $statement->bindValue(':id_event', $id_event);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function setSignOnsByEventId($id_event) : void {
        $this->loadData($this->getSignOnsByEventId($id_event));
    }

    public function save() : bool {
        $db = new Database();
        $statement = $db->prepare('INSERT INTO eventSignOn (id_Event, id_User, signOnDate, ratingHost, ratingAttendee, accepted) VALUES (:id_event, :id_user, :signOnDate, :ratingHost, :ratingAttendee, :accepted)');
        $statement->bindValue(':id_event', $this->id_Event);
        $statement->bindValue(':id_user', $this->id_User);
        $statement->bindValue(':signOnDate', $this->signOnDate);
        $statement->bindValue(':ratingHost', $this->ratingHost);
        $statement->bindValue(':ratingAttendee', $this->ratingAttendee);
        $statement->bindValue(':accepted', $this->accepted);
        return $statement->execute();
    }

    public function delete() {
        $db = new Database();
        $statement = $db->prepare('DELETE FROM eventSignOn WHERE id_Event = :id_event AND id_user = :id_user');
        $statement->bindValue(':id_event', $this->id_Event);
        $statement->bindValue(':id_user', $this->id_User);
        $statement->execute();
    }

    public function update() : bool {
        $db = new Database();
        $statement = $db->prepare('UPDATE eventSignOn SET ratingHost = :ratingHost, ratingAttendee = :ratingAttendee, accepted = :accepted WHERE id_Event = :id_event AND id_user = :id_user');
        $statement->bindValue(':id_event', $this->id_Event);
        $statement->bindValue(':id_user', $this->id_User);
        $statement->bindValue(':ratingHost', $this->ratingHost);
        $statement->bindValue(':ratingAttendee', $this->ratingAttendee);
        $statement->bindValue(':accepted', $this->accepted);
        return $statement->execute();
    }

    public function updateHostRating() {
        $db = new Database();
        $statement = $db->prepare('UPDATE eventSignOn SET ratingHost = :ratingHost WHERE id_Event = :id_Event AND id_User = :id_User');
        $statement->bindValue(':ratingHost', $this->ratingHost);
        $statement->bindValue(':id_Event', $this->id_Event);
        $statement->bindValue(':id_User', $this->id_User);
        return $statement->execute();
    }


    public function updateAttendeeRating() {
        $db = new Database();
        $statement = $db->prepare('UPDATE eventSignOn SET ratingAttendee = :ratingAttendee WHERE id_Event = :id_Event AND id_User = :id_User');
        $statement->bindValue(':ratingAttendee', $this->ratingAttendee);
        $statement->bindValue(':id_Event', $this->id_Event);
        $statement->bindValue(':id_User', $this->id_User);
        return $statement->execute();
    }

}