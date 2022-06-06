<?php

class Controller {
    public string $layout = 'frontend';
    public string $action = '';

    public function render($view) : string {
        return Application::$app->router->renderView($view);
    }

}