<?php

require_once 'Controller.php';

class SiteController extends Controller  {
    public function home() {
        $this->setLayout('basic');
        return $this->render("landingpage");
    }
}