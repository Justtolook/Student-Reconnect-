<?php
require_once 'Controller.php';
require_once 'app/frontend/models/NotificationModel.php';
require_once 'app/frontend/models/MatchModel.php'; 

class NotificationsController extends Controller {
    public int $id_myself;
    public NotificationModel $NotificationModel;

    public function __construct(){
        if(!$this->isLoggedIn()) Application::$app->response->redirect("?t=frontend&request=login");
        $this->id_myself = $_SESSION['user']['id_user'];
        $this->NotificationModel = new NotificationModel($this->id_myself);
    }
    
        
    
    public function notifications() {
        return $this->render("notifications", ["notifications" => $this->NotificationModel]);
    }


}