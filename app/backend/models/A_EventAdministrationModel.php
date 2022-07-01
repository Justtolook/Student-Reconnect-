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



}