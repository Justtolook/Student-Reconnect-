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

    /**
     * @param $queryResult
     * @return void
     * initializes the events array with the given events from query result
     */
    public function initEvents($queryResult) {
        //var_dump($queryResult);
        foreach ($queryResult as $event) {
            $eventModel = new EventModel();
            $eventModel->loadData($event);
            $eventModel->fetchAndSetSignOns();
            $this->events[] = $eventModel;
        }
        //$this->removePastEvents();
    }

    /**
     * @return array|false
     * Return all events as a query result
     */
    public function fetchAllEvents() {
        $statement = $this->db->prepare('SELECT * FROM event');
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * @param $eid
     * @return false|mixed
     * return an event object for the given event id
     */
    public function getEventById($eid) {
        foreach($this->events as $event) {
            if($event->id_event == $eid) {
                return $event;
            }
        }
        return false;
    }

    /**
     * @param $uid
     * @return array
     * Return all events the signed in user has created
     */
    public function getMyEvents($uid) {
        $myEvents = [];
        foreach($this->events as $event) {
            if($event->id_userCreator == $uid) {
                $myEvents[] = $event;
            }
        }
        return $myEvents;
    }

    /**
     * @param $eid
     * @return void
     * deletes an event from the database and the events array
     */
    public function deleteEvent($eid) {
        $event = $this->getEventById($eid);
        if($event) {
            $event->delete();
            $this->events = array_filter($this->events, function($event) use ($eid) {
                return $event->id_event != $eid;
            });
        }
    }

    /**
     * @param $searchTerm
     * @return array of events
     * Searches for events with the given search term in their name or description. (Case insensitive)
     */
    public function searchEvents($searchTerm) {
        $searchResults = [];
        foreach($this->events as $event) {
            if(stripos($event->name, $searchTerm) !== false || strpos($event->description, $searchTerm) !== false) {
                $searchResults[] = $event;
            }
        }
        return $searchResults;
    }

    /**
     * @return void
     * removes all past events from the events array
     */
    public function removePastEvents() {
        $this->events = array_filter($this->events, function($event) {
            return strtotime($event->eventDate) > time();
        });
    }

}