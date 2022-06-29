<?php
require_once 'Controller.php';
require_once 'app/backend/models/UserAdministrationModel.php';

class UserController extends Controller {
    public UserAdministrationModel $userAdministrationModel;
    public function __construct() {
        /**
         * check if user is logged in. If they are not, user will be redirected to the login page
         */
        //if(!$this->isLoggedIn()) Application::$app->response->redirect("?t=frontend&request=login");

        //set systemtype to backend of the application
        Application::$systemType = "backend";
        $this->userAdministrationModel = new UserAdministrationModel();
    }
    public function home() {

        return $this->render('UserAdministration', ['users' => $this->userAdministrationModel->users]);
    }


}