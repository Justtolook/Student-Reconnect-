<?php
include_once 'Request.php';

class Router {
    public array $routeMap;
    //public string $request;
    public Request $request;
    public Response $response;
    protected array $routes;

    public function __construct(Request $request, Response $response) {
        //$this->request = $this->getRequest();
        $this->request = $request;
        $this->response = $response;

        echo "method: " . $request->getMethod();
    }

    public function setRoute($method, $systype, $request, $callback) {
        $this->routes[$method][$systype][$request] = $callback;
    }

    public function getRequest() {
        if(isset($_GET)) return $_GET["request"];
        else return null;
    }

    public function resolve() {

        $callback = $this->routes[$this->request->method][$this->request->systype][$this->request->request] ?? false;
        if($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }
        if(is_string($callback)) {
            return $this->renderView($callback);
        }
        if(is_array($callback)) {
            $callback[0] = new $callback[0](); //code used to create an instantiated class as a parameter for callback (relevant as of php 8.0)
        }
        return call_user_func($callback, $this->request);
    }

    /**
     * Resolve the Request and return is corresponding view
     * @return String
     */
    /*public function resolve() {

        //no request
        if (!isset($this->request)) {
            echo "error";
            var_dump($this->request);
        }
        //no match with systemtype
        if (!array_key_exists($this->request->systype, $this->routeMap)) {
            return "error: could find systemtype in resolver method";
        }
        //no match with resolver method
        if (!in_array($this->request->request, $this->routeMap[$this->request->systype])) {
            return "error: could find allowed request in resolver method";
        }
        //set systemtype in application instance
        switch($this->request->systype) {
                case "f":
                Application::$systemType = "frontend";
                break;
            case "b":
                Application::$systemType = "backend";
                break;
            default:
                echo "Error: Could not find systemtype in Resolver";
        }

        //return $this->renderView($this->request->request, Application::$systemType);
    }
*/
    public function renderView($view) {
        return Application::$app->view->renderView($view, Application::$systemType);
    }
}
