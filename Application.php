<?php

require_once 'Router.php';
require_once 'Request.php';
require_once 'Controller.php';
require_once 'View.php';

class Application {
    public static Application $app;
    public static string $ROOT_DIR = __DIR__;
    public static string $systemType;
    public string $layout = 'main';
    public Router $router;
    public Request $request;
    public ?Controller $controller = null;
    public View $view;

    public function __construct() {
        self::$app = $this;
        self::$systemType = "frontend";
        $this->request = new Request();
        $this->router = new Router($this->request);
        $this->view = new View();
    }
    public function run() {
        echo $this->router->resolve();
    }

    public function renderView($view) {
        $layoutName = Application::$app->layout;
        if(Application::$app->controller) {
            $layoutName = Application::$app->controller->layout;
        }

    }
}
?>