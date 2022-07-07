<?php
require_once 'Controller.php';
require_once 'app/frontend/models/NotificationModel.php';
require_once 'app/frontend/models/MatchModel.php'; 
require_once 'app/frontend/models/VisitenkartenModel.php';


class NotificationsController extends Controller {
    public int $id_myself;
    public NotificationModel $NotificationModel;
    public VisitenkartenModel $VisitenkartenModel;

    public function __construct(){
        if(!$this->isLoggedIn()) Application::$app->response->redirect("?t=frontend&request=login");
        $this->id_myself = $_SESSION['user']['id_user'];
        $this->NotificationModel = new NotificationModel($this->id_myself);
        $this->VisitenkartenModel = new VisitenkartenModel($this->id_myself);
    }
    
        
    
    public function notifications() {
        return $this->render("notifications", ["notifications" => $this->NotificationModel]);
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

}