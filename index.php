<?php

require_once 'Application.php';
require_once 'app/frontend/controllers/SiteController.php';
require_once 'app/frontend/controllers/ProfileController.php';
require_once 'app/frontend/controllers/AuthController.php';

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
$app->router->setRoute("get", "frontend", "landingpage", [SiteController::class, 'home']);
$app->router->setRoute("get","frontend", "profile", [ProfileController::class, 'home']);
$app->router->setRoute("post","frontend", "login", [SiteController::class, 'handleLogin']);
$app->router->setRoute("get","frontend", "login", [AuthController::class, 'login']);
$app->router->setRoute("post","frontend", "login", [AuthController::class, 'handleLogin']);
$app->router->setRoute("get","frontend", "register", [AuthController::class, 'register']);
$app->router->setRoute("post","frontend", "register", [AuthController::class, 'handleRegister']);

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