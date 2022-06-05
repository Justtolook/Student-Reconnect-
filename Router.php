<?php
include_once 'Request.php';

class Router {
    public array $routeMap;
    //public string $request;
    public Request $request;

    public function __construct(Request $request) {
        //$this->request = $this->getRequest();
        $this->request = $request;
    }

    public function getRequest() {
        if(isset($_GET)) return $_GET["request"];
        else return null;
    }

    /**
     * Resolve the Request and return is corresponding view
     * @return String
     */
    public function resolve() {
        if (!isset($this->request)) {
            echo "error";
            var_dump($this->request);
        }
        if (!array_key_exists($this->request->systype, $this->routeMap)) {
            return "error: could find systemtype in resolver method";
        }
        if (!in_array($this->request->request, $this->routeMap[$this->request->systype])) {
            return "error: could find allowed request in resolver method";
        }
        /*echo "Request: " . $this->request->request . "<br>";
        echo "SystemType: " . $this->request->systype . "<br>";
        */

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
        return $this->renderView($this->request->request, Application::$systemType);
    }

    public function renderView($view) {
        //echo "Start to renderView in router.php<br>";
        return Application::$app->view->renderView($view, Application::$systemType);
    }
}
