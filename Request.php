<?php

class Request {
    public string $systype;
    public string $request;
    public string $method;
    public string $action;
    public array $param;

    public function __construct() {
        $this->systype = $this->fetchSysType();
        $this->request = $this->fetchRequest();
        $this->method = strtolower($this->getMethod());
    }

    public function getMethod() {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function fetchSysType() {
        if(!isset($_GET["t"])) return "frontend"; //set default sysType if not set
        return $_GET["t"];
    }

    public function fetchRequest() {
        if(!isset($_GET["request"])) return "landingpage"; //set default request if not set
        return $_GET["request"];
    }

    /**
     * @return array
     * get the body of a get/post request (e.g. additional information like username, password, etc.) and save them in an array
     *  with the associated key
     *
     * Note: get request might not be needed as standard information is already saved as object attributes ($systype, $request)
     */
    public function getBody() {
        $body = [];

        if($this->getMethod() === 'get') {
            foreach($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if($this->getMethod() === 'post') {
            foreach($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

}