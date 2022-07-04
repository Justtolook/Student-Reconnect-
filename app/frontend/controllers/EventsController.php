<?php

require_once 'Controller.php';
require_once 'app/frontend/models/EventFeedModel.php';
require_once 'app/frontend/models/UserModel.php';

class EventsController extends Controller {
    public EventFeedModel $eventFeedModel;

    public function __construct() {
        $this->eventFeedModel = new EventFeedModel();
        $this->eventFeedModel->initEvents($this->eventFeedModel->fetchAllEvents());
    }

    /**
     * @return string
     * return the view for the event feed
     */
    public function events() {
        return $this->render('events');
    }

    /**
     * @return void
     * returns a json object with all events
     */
    public function API_getAllEvents() {
        //$this->eventFeedModel->initEvents($this->eventFeedModel->fetchAllEvents());
        $this->renderEventCards($this->eventFeedModel->events);
    }

    /**
     * @param $eid
     * @return void
     * returns a json object with the event details for the given id
     */
    public function API_getEventDetails(Request $request) {
        $eid = $request->getBody()['eid'];
        $event = $this->eventFeedModel->getEventById($eid);
        $event = array (
            'id_event' => $event->id_event,
            'name' => $event->name,
            'description' => $event->description,
            'location_rough' => $event->location_rough,
            'eventDate' => $event->eventDate,
            'id_userCreator' => $event->id_userCreator,
            'createdTimestamp' => $event->createdTimestamp,
            'numberAttendees' => $event->numberAttendees,
            'numberSignOns' => $event->countSignOnsAccepted(),
            'signOnStatus' => $event->getSignOnStatus($this->getIDUser())
        );
        echo json_encode($event);
    }

    /**
     * @param Request $request
     * @return void
     * toggles the sign on status for the current user for the given event
     */
    public function API_toggleSignOnForEvent(Request $request) {
        $eid = $request->getBody()['eid'];
        $uid = $this->getIDUser();
        $this->eventFeedModel->getEventById($eid)->toggleSignOn($uid);
    }

    /**
     * @param Request $request
     * @return void
     * renders the event cards, the logged in user has created
     */
    public function API_getMyEvents(Request $request) {
        $uid = $this->getIDUser();
        $events = $this->eventFeedModel->getMyEvents($uid);
        $this->renderEventCards($events);
    }

    /**
     * @param $events
     * @return void
     * renders the event cards for the given events with an output buffer
     */
    public function renderEventCards($events) {
        ob_start();
        foreach ($events as $event) {
            echo $this->renderContent('eventcard', ['event' => $event]);
        }
        echo ob_get_clean();
    }

    /**
     * @param Request $request
     * @return void
     * deletes the event with the given id
     * result is a json object with the status of the deletion
     */
    public function API_deleteEvent(Request $request) {
        $eid = $request->getBody()['eid'];
        $uid = $this->getIDUser();
        if($this->eventFeedModel->getEventById($eid)->getIDUserCreator() == $uid) {
            $this->eventFeedModel->deleteEvent($eid);
            echo json_encode(['success' => true]);
        }
        else {
            echo json_encode(array(
                'success' => false,
                'error' => 'Du bist nicht der Ersteller dieses Events!'));
        }
    }

    /**
     * @param Request $request
     * @return void
     * renders attendee list items for a specific event with an output buffer
     */
    public function API_getAttendees(Request $request) {
        $eid = $request->getBody()['eid'];
        $attendees = $this->eventFeedModel->getEventById($eid)->signOns;
        ob_start();
        foreach ($attendees as $attendee) {
            $user = new UserModel();
            $user = $user->getUserById($attendee->id_User);
            echo $this->renderContent('attendeelistitem', ['attendee' => $attendee, 'user' => $user]);
        }
        echo ob_get_clean();
    }

    /**
     * @param Request $request
     * @return void
     * toggles the acceptance status for the given event and user
     * result is a json object with the status of the toggle
     */
    public function API_toggleAcceptance(Request $request) {
        $eid = $request->getBody()['eid'];
        $uid = $request->getBody()['uid'];
        if($this->eventFeedModel->getEventById($eid)->id_userCreator == $this->getIDUser()) {
            $newStatus = $this->eventFeedModel->getEventById($eid)->toggleAcceptance($uid);
            echo json_encode(['success' => true,
                'newStatus' => $newStatus]);
        }
        else {
            echo json_encode(array(
                'success' => false,
                'error' => 'Du bist nicht der Ersteller dieses Events!'));
        }
    }

    /**
     * @param Request $request
     * @return void
     * outputs a json object with with all events matching the search term
     */
    public function API_searchEvents(Request $request) {
        $searchTerm = $request->getBody()['searchTerm'];
        $events = $this->eventFeedModel->searchEvents($searchTerm);
        $this->renderEventCards($events);
    }

}