<?php

class View
{
    public function renderView($view, $systemType, array $params) {
        $layoutName = Application::$app->controller->layout;
        $viewContent = $this->renderViewContent($view, $systemType, $params); //TODO
        ob_start();
        include_once Application::$ROOT_DIR."/app/$systemType/views/layouts/$layoutName.php";
        $layoutContent = ob_get_clean();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderViewContent ($view, $systemType, array $params) {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/app/$systemType/views/$view.php";
        return ob_get_clean();
    }
}