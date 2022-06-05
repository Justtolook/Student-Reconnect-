<?php

require_once 'Application.php';
$app = new Application();

/**
 * @routeMap
 * Define the allowed Requests (e.g. index.php?request=landingPage)
 * and define if it shall route the frontend or backend.
 *
 * Important: Definition is Case Sensitive!
 */


$routeMap = array(
        "f" => array(
                "landingpage",
            "contact",
            "login",
            "profile"
        ),
        "b" => array(
                "landingpage"
)
);
$app->router->routeMap = $routeMap;
$app->run();



?>
<!--
<div>
<a href="?t=f&request=landingpage">
    landingpage frontend
</a>
</div>

<a href="?t=b&request=landingpage">
    landingpage backend
</a>
-->