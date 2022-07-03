<?php
require_once 'Model.php';
require_once 'Database.php';
require_once 'app/backend/models/A_EventModel.php';

class A_EventAdministrationModel extends Model {
    public array $events;
    public Database $db;

    public function __construct() {
        $this->db = new Database();
        $this->createEventModels($this->getEvents());
    }

    public function rules(): array {
        return [];
    }

    public function getEvents() {
        $statement = $this->db->prepare('SELECT * FROM event');
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * method to create EventModel objects from all the results of the database query
     */
    public function createEventModels($eventQuery) {
        foreach ($eventQuery as $event) {
            $eventModel = new A_EventModel();
            $eventModel->loadData($event);
            $eventModel->fetchAndSetSignOns();
            $this->events[] = $eventModel;
        }
    }

    /**
     * return the EventModel object for the given id from the events array
     */
    public function getEventById($id_event) {
        //$uid = $request->getBody()['uid'];
        foreach ($this->events as $event) {
            if ($event->id_event == $id_event) {
                return $event;
            }
        }
    }

    public function toggleAttendeeAcceptance($id_event, $id_user) {
        $db = new Database();
        //get the current status of the signon
        foreach($this->getEventById($id_event)->signOns as $signOn) {
            if ($signOn->id_User == $id_user) {
                $currentStatus = $signOn->accepted;
                $signOn->accepted = !$currentStatus;
            }
        }
        if($currentStatus == 0) {
            $statement = $db->prepare('UPDATE eventSignOn SET accepted = 1 WHERE id_event = :id_event AND id_user = :id_user');
        } else {
            $statement = $db->prepare('UPDATE eventSignOn SET accepted = 0 WHERE id_event = :id_event AND id_user = :id_user');
        }
        $statement->bindValue(':id_event', $id_event);
        $statement->bindValue(':id_user', $id_user);
        $statement->execute();
    }

    /**
     * @param $id_event
     * @param $id_user
     * @return void
     * Delete the event signOn for the given user and event from the database
     */
    public function deleteAttendee($id_event, $id_user) {
        $db = new Database();
        $statement = $db->prepare('DELETE FROM eventSignOn WHERE id_event = :id_event AND id_user = :id_user');
        $statement->bindValue(':id_event', $id_event);
        $statement->bindValue(':id_user', $id_user);
        $statement->execute();
        //remove user from the signOn array in the eventModel
        foreach($this->events as $event) {
            if ($event->id_event == $id_event) {
                foreach($event->signOns as $signOn) {
                    if ($signOn->id_User == $id_user) {
                        $event->signOns = array_diff($event->signOns, [$signOn]);
                    }
                }
            }
        }

    }



}