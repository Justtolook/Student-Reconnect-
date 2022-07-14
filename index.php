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
require_once 'app/backend/controllers/A_UserController.php';
require_once 'app/backend/controllers/A_InterestsController.php';
require_once 'app/backend/controllers/A_EventsController.php';
require_once 'app/frontend/controllers/VisitenkartenController.php';

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
$app->router->setRoute("post","frontend", "notifications/markAsReadNotification", [NotificationsController::class, 'markAsReadNotification'], 1);
$app->router->setRoute("post","frontend", "notifications/showVisitenkarte", [NotificationsController::class, 'showVisitenkarte'], 1);
$app->router->setRoute("get","frontend", "API_handleHostRating", [NotificationsController::class, 'API_handleHostRating'], 1);
$app->router->setRoute("get","frontend", "API_handleAttendeeRating", [NotificationsController::class, 'API_handleAttendeeRating'], 1);
$app->router->setRoute("get", "frontend", "API_getVisitenkarte", [VisitenkartenController::class, 'API_getVisitenkarte'], 1);
$app->router->setRoute("get","frontend", "profile", [ProfileController::class, 'profile'], 1);
$app->router->setRoute("get","frontend", "login", [AuthController::class, 'login'], 0);
$app->router->setRoute("post","frontend", "login", [AuthController::class, 'handleLogin'], 0);
$app->router->setRoute("get","frontend", "logout", [AuthController::class, 'logout'], 0);
$app->router->setRoute("post","frontend", "logout", [AuthController::class, 'logout'], 0);
$app->router->setRoute("get","frontend", "settings", [SettingsController::class, 'settings'], 1);
$app->router->setRoute("get","frontend", "settings", [SettingsController::class, 'settings'], 1);
$app->router->setRoute("post","frontend", "settings", [SettingsController::class, 'settings'], 1);
$app->router->setRoute("get","frontend", "impressum", [SettingsController::class, 'impressum'], 1);

$app->router->setRoute("get","frontend", "events", [EventsController::class, 'events'], 1);
$app->router->setRoute("post","frontend", "events", [EventsController::class, 'events'], 1);
$app->router->setRoute("get","frontend", "API_getAllEvents", [EventsController::class, 'API_getAllEvents'], 1);
$app->router->setRoute("get","frontend", "API_getEventDetails", [EventsController::class, 'API_getEventDetails'], 1);
$app->router->setRoute("get","frontend", "API_toggleSignOnForEvent", [EventsController::class, 'API_toggleSignOnForEvent'], 1);
//$app->router->setRoute("get","frontend", "API_reportEvent", [EventsController::class, 'API_reportEvent'], 1);
$app->router->setRoute("get","frontend", "API_getMyEvents", [EventsController::class, 'API_getMyEvents'], 1);
$app->router->setRoute("get","frontend", "API_deleteEvent", [EventsController::class, 'API_deleteEvent'], 1);
$app->router->setRoute("get","frontend", "API_getAttendees", [EventsController::class, 'API_getAttendees'], 1);
$app->router->setRoute("get","frontend", "API_toggleAcceptance", [EventsController::class, 'API_toggleAcceptance'], 1);
$app->router->setRoute("get","frontend", "API_searchEvents", [EventsController::class, 'API_searchEvents'], 1);


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
$app->router->setRoute("get","frontend", "reportEvent", [ModerationController::class, 'reportEvent'], 1);
$app->router->setRoute("post","frontend", "handleReport", [ModerationController::class, 'handleReport'], 1);


$app->router->setRoute("get","backend", "user", [A_UserController::class, 'home'], 3);
$app->router->setRoute("post","backend", "user", [A_UserController::class, 'home'], 3);
$app->router->setRoute("get","backend", "API_getUser", [A_UserController::class, 'API_getUserById'], 3);
$app->router->setRoute("post","backend", "API_editUser", [A_UserController::class, 'API_editUser'], 3);
$app->router->setRoute("post","backend", "API_deleteUser", [A_UserController::class, 'API_deleteUser'], 3);

$app->router->setRoute("get","backend", "events", [A_EventsController::class, 'home'], 3);
$app->router->setRoute("get","backend", "API_getEvents", [A_EventsController::class, 'API_getEvents'], 3);
$app->router->setRoute("get","backend", "API_getEventById", [A_EventsController::class, 'API_getEventById'], 3);
$app->router->setRoute("get","backend", "API_deleteEvent", [A_EventsController::class, 'API_deleteEvent'], 3);
$app->router->setRoute("post","backend", "API_editEvent", [A_EventsController::class, 'API_editEvent'], 3);
$app->router->setRoute("get","backend", "API_getAttendeesByEventId", [A_EventsController::class, 'API_getAttendeesByEventId'], 3);
$app->router->setRoute("get","backend", "API_toggleAttendeeAcceptance", [A_EventsController::class, 'API_toggleAttendeeAcceptance'], 3);
$app->router->setRoute("get","backend", "API_deleteAttendee", [A_EventsController::class, 'API_deleteAttendee'], 3);


$app->router->setRoute("get","backend", "interests", [A_InterestsController::class, 'home'], 3);
$app->router->setRoute("get","backend", "API_getInterest", [A_InterestsController::class, 'API_getInterest'], 3);
$app->router->setRoute("post","backend", "API_editInterest", [A_InterestsController::class, 'API_editInterest'], 3);
$app->router->setRoute("post","backend", "API_addInterest", [A_InterestsController::class, 'API_addInterest'], 3);
$app->router->setRoute("get","backend", "API_deleteInterest", [A_InterestsController::class, 'API_deleteInterest'], 3);

$app->run();




?>