<?php
require_once 'Controller.php';

class NotificationsController extends Controller {
    public function notifications() {
        //$this->setLayout('main');
        return $this->render("notifications");
    }

}