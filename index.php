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
    "landingpage" => "frontend",
    "Contact" => "frontend",
    "landingpage" => "backend");

$routeMapTest = array(
        "f" => array(
                "landingpage",
            "contact"
        ),
        "b" => array(
                "landingpage"
)
);
$app->router->routeMap = $routeMapTest;
$app->run();



?>
<div>
<a href="/main/index.php?t=f&request=landingpage">
    landingpage frontend
</a>
</div>

<a href="/main/index.php?t=b&request=landingpage">
    landingpage backend
</a>
