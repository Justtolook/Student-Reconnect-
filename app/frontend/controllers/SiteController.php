<?php

require_once 'Controller.php';

class SiteController extends Controller  {
    public function home() {
        $this->setLayout('basic');
        return $this->render("landingpage");
    }

    public function notifications() {
        $this->setLayout('main');
        return $this->render("notifications");
    }

   public function settings() {
        $this->setLayout('main');
        return $this->render("settings");
    }
}