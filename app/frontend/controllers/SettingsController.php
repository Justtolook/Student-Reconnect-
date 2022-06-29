<?php
require_once 'Controller.php';

class SettingsController extends Controller {
    public function settings() {
        //$this->setLayout('main');
        return $this->render('settings');
    }

}