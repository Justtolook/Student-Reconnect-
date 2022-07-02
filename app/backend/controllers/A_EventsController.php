<?php
require_once 'Controller.php';
require_once 'app/backend/models/A_EventAdministrationModel.php';

class A_EventsController extends Controller{
    public A_EventAdministrationModel $eventAdministrationModel;

    public function __construct() {
        //set systemtype to backend of the application
        Application::$systemType = "backend";
        $this->eventAdministrationModel = new A_EventAdministrationModel();
    }

    public function home() {
        return $this->render('EventsAdministration', ['events' => $this->eventAdministrationModel->events]);
    }

    public function API_getEventById(Request $request) {
        $id_event = $request->getBody()['eid'];
        $event = $this->eventAdministrationModel->getEventById($id_event);
        echo json_encode($event);
    }

    public function API_editEvent(Request $request) {
        $id_event = $request->getBody()['id_event'];
        var_dump($id_event);
        $event = $this->eventAdministrationModel->getEventById($id_event);
        $event->loadData($request->getBody());
        $event->save();
        Application::$app->response->redirect("?t=backend&request=events");
    }

    public function API_getAttendeesByEventId(Request $request) {
        $id_event = $request->getBody()['eid'];
        $attendees = $this->eventAdministrationModel->getEventById($id_event)->signOns;
        echo json_encode($attendees);
    }

    public function API_toggleAttendeeAcceptance(Request $request) {
        $id_event = $request->getBody()['eid'];
        $id_user = $request->getBody()['uid'];
        $this->eventAdministrationModel->toggleAttendeeAcceptance($id_event, $id_user);
        echo json_encode($this->eventAdministrationModel->getEventById($id_event)->signOns);
    }

    public function API_deleteAttendee(Request $request) {
        $id_event = $request->getBody()['eid'];
        $id_user = $request->getBody()['uid'];
        $this->eventAdministrationModel->deleteAttendee($id_event, $id_user);
        echo json_encode($this->eventAdministrationModel->getEventById($id_event)->signOns);
    }


}