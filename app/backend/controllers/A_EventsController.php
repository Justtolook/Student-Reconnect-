<?php
require_once 'Controller.php';
require_once 'A_InterestsController.php';

class A_EventsController extends Controller{

    public function __construct() {
        //set systemtype to backend of the application
        Application::$systemType = "backend";
    }

    public function home() {
        return $this->render('EventsAdministration');
    }
}