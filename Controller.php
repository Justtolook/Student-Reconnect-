<?php

class Controller {
    public string $layout = 'main'; //Attribute used to specify the layout to be used e.g. main vs. basic (no footer)
    public string $action = '';

    public function render($view, $params = []) : string {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }

}