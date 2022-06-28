<?php
include_once 'Request.php';

class Router {
    public Request $request;
    public Response $response;
    protected array $routes;

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }

    public function setRoute($method, $systype, $request, $callback, $permissionNeed) {
        $this->routes[$method][$systype][$request]['callback'] = $callback;
        $this->routes[$method][$systype][$request]['permissionNeed'] = $permissionNeed;
    }

    public function getRequest() {
        if(isset($_GET)) return $_GET["request"];
        else return null;
    }

    /**
     * Resolve the called request and execute the callback declared in $routes
     * @return mixed|String
     *
     */
    public function resolve() {
        $callback = $this->routes[$this->request->method][$this->request->systype][$this->request->request]['callback'] ?? false;
        $permissionNeeded = $this->routes[$this->request->method][$this->request->systype][$this->request->request]['permissionNeed'] ?? false;
        if($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }
        if(is_string($callback)) {
            return $this->renderView($callback);
        }
        if($permissionNeeded === false) {
            $this->response->setStatusCode(403);
            return $this->renderView("_403");
        }
        if(is_array($callback)) {
            //check for permissions and unnecessary site calls
            //if(!Application::$app->controller->isRoleSet()) Application::$app->controller->setRoleZero;
            if(!Application::$app->controller->isLoggedIn() && $permissionNeeded > 0) {
                Application::$app->response->redirect("?t=frontend&request=login");
            }
            if(Application::$app->controller->isLoggedIn() && $permissionNeeded === 0) {
                Application::$app->response->redirect("?t=frontend&request=matching");
            }
            if(Application::$app->controller->isLoggedIn() && $permissionNeeded > Application::$app->controller->getUserRole()) {
                return $this->renderView("_403");
            }
            //replace standard controller with custom controller
            Application::$app->controller = new $callback[0](); //code used to create an instantiated class as a parameter for callback (relevant as of php 8.0)
            $callback[0] = Application::$app->controller;
        }
        return call_user_func($callback, $this->request);
    }

    /**
     * Resolve the Request and return is corresponding view
     * @return String
     */

    public function renderView($view, $params = []) {
        return Application::$app->view->renderView($view, Application::$systemType, $params);
    }
}
