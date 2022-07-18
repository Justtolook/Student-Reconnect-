<?php
require_once 'Controller.php';
require_once 'app/frontend/models/NotificationModel.php';
require_once 'app/frontend/models/MatchModel.php'; 
require_once 'app/frontend/models/VisitenkartenModel.php';
require_once 'app/frontend/models/EventModel.php';
require_once 'app/frontend/models/UserModel.php';
require_once 'app/frontend/models/ShowProfileModel.php';
require_once 'app/frontend/models/EventSignOnModel.php';

class NotificationsController extends Controller {
    public int $id_myself;
    public NotificationModel $NotificationModel;
    public VisitenkartenModel $VisitenkartenModel;
    public EventModel $EventModel;
    public EventSignOnModel $EventSignOnModel;
    public UserModel $UserModel;
    public ShowProfileModel $ShowProfileModel;


    public function __construct(){
        if(!$this->isLoggedIn()) Application::$app->response->redirect("?t=frontend&request=login");
        $this->id_myself = $_SESSION['user']['id_user'];
        $this->NotificationModel = new NotificationModel($this->id_myself);
        $this->VisitenkartenModel = new VisitenkartenModel($this->id_myself);
        $this->EventModel = new EventModel();
        $this->EventSignOnModel = new EventSignOnModel();
        $this->UserModel = new UserModel();
    }
    
        
    
    public function notifications() {
        return $this->render("notifications", ["notifications" => $this->NotificationModel, "eventNotification" => $this->NotificationModel, "eventSignOn" => $this->EventSignOnModel, "userModel" => $this->UserModel]);
    }

    public function markAsReadNotification(Request $request){
        $id_user_match = $request->getBody()['id_user_match'];
        var_dump($id_user_match);
        $this->NotificationModel->setNotificationToRead($id_user_match);
        Application::$app->response->redirect("?t=frontend&request=notifications");
    }

    public function showVisitenkarte (Request $request) {
        $id_user_match = $request->getBody()['id_user_match'];
        $test = $this->VisitenkartenModel->getVisitenkartenByUserID($this->id_myself);
        return $test->render("profile", ["visitenkarte" => $this->VisitenkartenModel]);
    }

    
    public function handleHostRating(Request $request) {
        $eventModel = new EventSignOnModel();
        $eventModel->id_Event = $request->getBody()['id_event'];
        $eventModel->id_User = $this->getIDUser();
        $id_creator = $request->getBody()['id_userRated'];
        $eventModel->ratingHost = $request->getBody()['rating'];
        
        if($eventModel->updateHostRating()) {
            $score = $eventModel->ratingHost - 2;
            $ShowProfileModel = new ShowProfileModel($id_creator);
            $ShowProfileModel->scoreHost = $score;
            if($ShowProfileModel->updateScoreHost()) {
                Application::$app->response->redirect("?t=frontend&request=notifications");
                return;
            }
        }
        return $this->render("notifications");
    }


    public function handleAttendeeRating(Request $request) {
        $numberAttendees = $request->getBody()['counter'];
        var_dump($numberAttendees);
        $counter = 1;
        while($counter < $numberAttendees) {
            $eventModel = new EventSignOnModel();
            $eventModel->id_Event = $request->getBody()['id_event'];
            $eventModel->id_User = $request->getBody()['id_User' . $counter];
            $eventModel->ratingAttendee = $request->getBody()['attendeeRating' . $counter];
            if($eventModel->updateAttendeeRating()) {
                $score = $eventModel->ratingAttendee - 2;
                $ShowProfileModel = new ShowProfileModel($eventModel->id_User);
                $ShowProfileModel->scoreAttendee = $score;
                $ShowProfileModel->updateScoreAttendee();
            }
            $counter ++;
        }
        Application::$app->response->redirect("?t=frontend&request=notifications");
        return;
    }

 /*   public function showEvent (Request $request){
        $id_user = $request->getBody()['id_user'];
        print "ID_USER: " . $id_user;
        $data = $this->eventModel->getAcceptedEvents($id_user);
        return $data->render("notifications", ["events" => $this->EventModel]);
    }  */
 

    /* public function API_getEventNotification (Request $request) {
        $event_id = $request->getBody()['event_id'];
        print "Event_ID: " . $event_id;
        $this->EventModel = new EventModel();
    }
 */
}