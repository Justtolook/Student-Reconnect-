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

    public function events() {
        return $this->render('events');
    }

    public function API_getAllEvents() {
        //$this->eventFeedModel->initEvents($this->eventFeedModel->fetchAllEvents());
        $this->renderEventCards($this->eventFeedModel->events);
    }

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

    public function API_toggleSignOnForEvent(Request $request) {
        $eid = $request->getBody()['eid'];
        $uid = $this->getIDUser();
        $this->eventFeedModel->getEventById($eid)->toggleSignOn($uid);
    }


    public function API_getMyEvents(Request $request) {
        $uid = $this->getIDUser();
        $events = $this->eventFeedModel->getMyEvents($uid);
        $this->renderEventCards($events);
    }

    public function renderEventCards($events) {
        ob_start();
        foreach ($events as $event) {
            echo $this->renderContent('eventcard', ['event' => $event]);
        }
        echo ob_get_clean();
    }

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

    public function API_searchEvents(Request $request) {
        $searchTerm = $request->getBody()['searchTerm'];
        $events = $this->eventFeedModel->searchEvents($searchTerm);
        $this->renderEventCards($events);
    }

}