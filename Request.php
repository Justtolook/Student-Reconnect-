<?php

class Request {
    public string $systype;
    public string $request;

    public function __construct() {
        $this->systype = $this->fetchSysType();
        $this->request = $this->fetchRequest();
    }

    public function getMethod() {
        return $_SERVER["REQUEST_METHOD"];
    }

    public function fetchSysType() {
        if(!isset($_GET["t"])) return "f"; //set default sysType if not set
        return $_GET["t"];
    }

    public function fetchRequest() {
        if(!isset($_GET["request"])) return "landingpage"; //set default request if not set
        return $_GET["request"];
    }




}