<?php

require_once 'Application.php';
require_once 'app/frontend/controllers/SiteController.php';
require_once 'app/frontend/controllers/ProfileController.php';
require_once 'app/frontend/controllers/AuthController.php';
require_once 'app/frontend/controllers/EventsController.php';
require_once 'app/frontend/controllers/MatchingController.php';
require_once 'app/frontend/controllers/ModerationController.php';
require_once 'app/frontend/controllers/SettingsController.php';
require_once 'app/frontend/controllers/NotificationsController.php';
require_once 'app/backend/controllers/UserController.php';

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
 *  permissionNeed (int): 0 for public, 1 for logged in, 2 for moderator, 3 for admin
 *
 * Important: Definition is Case Sensitive!
 * 
 * 0 = guest, 1 = user, 2 = moderator, 3 = admin
 */


$app->router->setRoute("get", "frontend", "landingpage", [SiteController::class, 'home'], 0);
$app->router->setRoute("get", "frontend", "notifications", [NotificationsController::class, 'notifications'], 1);
$app->router->setRoute("post", "frontend", "notifications", [NotificationsController::class, 'notifications'], 1);
$app->router->setRoute("get","frontend", "profile", [ProfileController::class, 'profile'], 1);
$app->router->setRoute("get","frontend", "login", [AuthController::class, 'login'], 0);
$app->router->setRoute("post","frontend", "login", [AuthController::class, 'handleLogin'], 0);
$app->router->setRoute("get","frontend", "logout", [AuthController::class, 'logout'], 0);
$app->router->setRoute("post","frontend", "logout", [AuthController::class, 'logout'], 0);
$app->router->setRoute("get","frontend", "settings", [SettingsController::class, 'settings'], 1);
$app->router->setRoute("get","frontend", "settings", [SettingsController::class, 'settings'], 1);
$app->router->setRoute("post","frontend", "settings", [SettingsController::class, 'settings'], 1);

$app->router->setRoute("get","frontend", "events", [EventsController::class, 'events'], 1);
$app->router->setRoute("post","frontend", "events", [EventsController::class, 'events'], 1);

$app->router->setRoute("get","frontend", "profileedit", [ProfileController::class, 'profileedit'], 1);

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

$app->router->setRoute("get","frontend", "moderation", [ModerationController::class, 'moderation'], 2);
$app->router->setRoute("post","frontend", "moderation", [ModerationController::class, 'moderation'], 2);


$app->router->setRoute("get","backend", "user", [UserController::class, 'home'], 3);
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