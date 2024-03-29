<?php

require_once 'Router.php';
require_once 'Request.php';
require_once 'Controller.php';
require_once 'View.php';
require_once 'Response.php';

class Application {
    public static Application $app;
    public static string $ROOT_DIR = __DIR__;
    public static string $systemType;
    public string $layout = 'main';
    public Router $router;
    public Request $request;
    public Response $response;
    public Controller $controller;
    public View $view;

    public function __construct() {
        session_start();
        self::$app = $this;
        self::$systemType = "frontend";
        $this->request = new Request();
        $this->response = new Response();
        $this->controller = new Controller();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();
    }
    public function run() {
        echo $this->router->resolve();
    }

}
?>