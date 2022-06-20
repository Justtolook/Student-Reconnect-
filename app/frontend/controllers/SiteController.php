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

    public function matching()  {
        return $this->render("matching");
    }

    public function events()  {
        return $this->render("events");
    }

    public function viewLogin() {
        return $this->render("login");
    }

    public function handleLogin(Request $request) {
        $body = $request->getBody();
        echo "<pre>";
        var_dump($body);
        echo "<pre>";
        return "handling login";
    }
}