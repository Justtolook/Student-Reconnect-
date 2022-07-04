<?php

require_once 'Model.php';
require_once 'Database.php';
require_once 'app/frontend/models/EventSignOnModel.php';
require_once 'app/frontend/models/EventModel.php';

class EventFeedModel extends Model{
    public array $events;
    public Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function rules(): array {
        return [];
    }

    public function initEvents($queryResult) {
        //var_dump($queryResult);
        foreach ($queryResult as $event) {
            $eventModel = new EventModel();
            $eventModel->loadData($event);
            $eventModel->fetchAndSetSignOns();
            $this->events[] = $eventModel;
        }
    }

    public function fetchAllEvents() {
        $statement = $this->db->prepare('SELECT * FROM event');
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getEventById($eid) {
        foreach($this->events as $event) {
            if($event->id_event == $eid) {
                return $event;
            }
        }
        return false;
    }

    public function getMyEvents($uid) {
        $myEvents = [];
        foreach($this->events as $event) {
            if($event->id_userCreator == $uid) {
                $myEvents[] = $event;
            }
        }
        return $myEvents;
    }

    public function deleteEvent($eid) {
        $event = $this->getEventById($eid);
        if($event) {
            $event->delete();
            $this->events = array_filter($this->events, function($event) use ($eid) {
                return $event->id_event != $eid;
            });
        }
    }

}