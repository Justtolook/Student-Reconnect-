<?php

require_once 'Controller.php';

class EventsController extends Controller {
    public function __construct() {
    }

    public function events() {
        return $this->render('events');
    }

}