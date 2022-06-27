<?php

require_once 'Application.php';
require_once 'app/frontend/controllers/SiteController.php';
require_once 'app/frontend/controllers/ProfileController.php';
require_once 'app/frontend/controllers/AuthController.php';
require_once 'app/frontend/controllers/EventsController.php';
require_once 'app/frontend/controllers/MatchingController.php';
require_once 'app/frontend/controllers/ModerationController.php';

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


$app->router->setRoute("get", "frontend", "landingpage", [SiteController::class, 'home'], 0);
$app->router->setRoute("get", "frontend", "notifications", [SiteController::class, 'notifications'], 0);
$app->router->setRoute("get","frontend", "profile", [ProfileController::class, 'profile'], 1);
$app->router->setRoute("get","frontend", "login", [AuthController::class, 'login'], 0);
$app->router->setRoute("post","frontend", "login", [AuthController::class, 'handleLogin'], 0);
$app->router->setRoute("post","frontend", "logout", [AuthController::class, 'logout'], 1);
$app->router->setRoute("get","frontend", "settings", [SiteController::class, 'settings'], 1);
$app->router->setRoute("post","frontend", "settings", [SiteController::class, 'settings'], 1);

$app->router->setRoute("get","frontend", "events", [EventsController::class, 'events'], 1);
$app->router->setRoute("post","frontend", "events", [EventsController::class, 'events'], 1);


$app->router->setRoute("get","frontend", "matching", [MatchingController::class, 'matching'], 1);
$app->router->setRoute("post","frontend", "matching", [MatchingController::class, 'matching'], 1);
$app->router->setRoute("post","frontend", "matching/matching", [MatchingController::class, 'addMatchingInstancePositive'], 1);
$app->router->setRoute("post","frontend", "matching/notmatching", [MatchingController::class, 'addMatchingInstanceNegative'], 1);
$app->router->setRoute("post","frontend", "matching/filter", [MatchingController::class, 'filter'], 1);
$app->router->setRoute("post","frontend", "matching/resetfilter", [MatchingController::class, 'resetFilter'], 1);
$app->router->setRoute("post","frontend", "matching/clearfilter", [MatchingController::class, 'clearFilter'], 1);


$app->router->setRoute("get","frontend", "register", [AuthController::class, 'register'], 0);
$app->router->setRoute("post","frontend", "register", [AuthController::class, 'handleRegistration'], 0);
$app->router->setRoute("get","frontend", "pwreset", [AuthController::class, 'pwReset'], 0);
$app->router->setRoute("post","frontend", "pwreset", [AuthController::class, 'handlePWReset'], 0);

$app->router->setRoute("post","frontend", "pwresetemail", [AuthController::class, 'handlePWResetEmail'], 0);

$app->router->setRoute("get","frontend", "moderation", [ModerationController::class, 'moderation'], 1); //TODO change to 2
$app->router->setRoute("post","frontend", "moderation", [ModerationController::class, 'moderation'], 1);

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