<?php

require_once 'Application.php';
require_once 'app/frontend/controllers/SiteController.php';
require_once 'app/frontend/controllers/ProfileController.php';
require_once 'app/frontend/controllers/AuthController.php';

$app = new Application();

/**
 * Define the allowed Requests (e.g. index.php?t=frontend&request=landingpage) by calling $app->router->setRoute()
 * setRoute expects 4 arguments:
 *  method (String): get or post
 *  systype (String): frontend or backend
 *  request (String): any specific request
 *  callback (array/function):
 *   -> controller class: any specific controller that shall handle the request
 *   -> action: the name of a function that shall be called and is defined in the above controller
 * Important: Definition is Case Sensitive!
 *
 */


$app->router->setRoute("get", "frontend", "landingpage", [SiteController::class, 'home']);
$app->router->setRoute("get", "frontend", "notifications", [SiteController::class, 'notifications']);
$app->router->setRoute("get","frontend", "profile", [ProfileController::class, 'home']);
$app->router->setRoute("post","frontend", "login", [SiteController::class, 'handleLogin']);
$app->router->setRoute("get","frontend", "login", [AuthController::class, 'login']);
$app->router->setRoute("post","frontend", "login", [AuthController::class, 'handleLogin']);
$app->router->setRoute("get","frontend", "register", [AuthController::class, 'register']);
$app->router->setRoute("post","frontend", "register", [AuthController::class, 'handleRegistration']);
$app->router->setRoute("get","frontend", "pwreset", [AuthController::class, 'pwReset']);
$app->router->setRoute("post","frontend", "pwreset", [AuthController::class, 'handlePWReset']);

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