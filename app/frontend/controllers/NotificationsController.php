<?php
require_once 'Controller.php';
require_once 'app/frontend/models/NotificationModel.php';
require_once 'app/frontend/models/MatchModel.php'; 
require_once 'app/frontend/models/VisitenkartenModel.php';
require_once 'app/frontend/models/EventModel.php';


class NotificationsController extends Controller {
    public int $id_myself;
    public NotificationModel $NotificationModel;
    public VisitenkartenModel $VisitenkartenModel;
    public EventModel $EventModel;

    public function __construct(){
        if(!$this->isLoggedIn()) Application::$app->response->redirect("?t=frontend&request=login");
        $this->id_myself = $_SESSION['user']['id_user'];
        $this->NotificationModel = new NotificationModel($this->id_myself);
        $this->VisitenkartenModel = new VisitenkartenModel($this->id_myself);
        $this->EventModel = new EventModel();
    }
    
        
    
    public function notifications() {
        return $this->render("notifications", ["notifications" => $this->NotificationModel, "eventNotification" => $this->NotificationModel]);
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