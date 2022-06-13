<?php
require_once 'Controller.php';
require_once 'app/frontend/models/RegisterModel.php';
require_once 'app/frontend/models/LoginModel.php';

class AuthController extends Controller {

    public function __construct() {
        /**
         * check if user is logged in.
         * If they are logged in redirect to the profile page as no login or registration is needed.
         */
        if($this->isLoggedIn()) Application::$app->response->redirect("?t=frontend&request=profile");
    }

    public function login() {
        $loginModel = new LoginModel();
        return $this->render('login', ['model' => $loginModel]);
    }

    //drop the session for the user
    public function logout() {
        unset($_SESSION['user']);
        Application::$app->response->redirect("?t=frontend&request=landingpage");
    }

    public function handleLogin(Request $request) {
        $loginModel = new LoginModel();
        $loginModel->loadData($request->getBody());
        //validate user input data for login
        if($loginModel->validate()) {
            /**
             * try to login the user with given credentials.
             * On success: $user will hold the fetched user data form the db
             * On failure: $user = false
             */
            $user = $loginModel->login();
            if($user) {
                $_SESSION['user'] = $user;
                Application::$app->response->redirect("?t=frontend&request=profile");
                return;
            }
        }
        //add an Error that will be used to show that user that the password is wrong
        $loginModel->addError("password", Model::RULE_WRONG_PASSWORD);
        return $this->render('login', ['model' => $loginModel]);
    }


    public function register(Request $request) {
        $registerModel = new RegisterModel();
        return $this->render('register', ['model' => $registerModel]);
    }

    public function handleRegistration(Request $request) {
        $registerModel = new RegisterModel();
        $registerModel->loadData($request->getBody());
        //check if registration data is valid and if the registration was successful s
        if($registerModel->validate() && $registerModel->register()) {
            Application::$app->response->redirect("?t=frontend&request=login"); //new (better?) option to redirect TODO
            return;
        }
        return $this->render('register', ['model' => $registerModel]);
    }

    public function pwReset() {
        return $this->render('pwreset');
    }

    public function handlePWReset(Request $request) {
        return 'handle submitted pwreset data';
    }

}