<?php

require_once 'Controller.php';

class EventsController extends Controller {
    public function __construct() {
        /**
         * check if user is logged in. If they are not, user will be redirected to the login page
         */
        if(!$this->isLoggedIn()) Application::$app->response->redirect("?t=frontend&request=login");
    }

    public function events() {
        return $this->render('events');
    }

}