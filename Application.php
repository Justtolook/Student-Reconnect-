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
    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
/*
    public function renderView($view) {
        $layoutName = Application::$app->layout;
        if(Application::$app->controller) {
            $layoutName = Application::$app->controller->layout;
        }

    }
*/
}
?>