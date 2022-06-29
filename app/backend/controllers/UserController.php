<?php
require_once 'Controller.php';
require_once 'app/backend/models/A_UserAdministrationModel.php';

class UserController extends Controller {
    public A_UserAdministrationModel $userAdministrationModel;
    public function __construct() {
        /**
         * check if user is logged in. If they are not, user will be redirected to the login page
         */
        //if(!$this->isLoggedIn()) Application::$app->response->redirect("?t=frontend&request=login");

        //set systemtype to backend of the application
        Application::$systemType = "backend";
        $this->userAdministrationModel = new A_UserAdministrationModel();
    }
    public function home() {

        return $this->render('UserAdministration', ['users' => $this->userAdministrationModel->users]);
    }


}