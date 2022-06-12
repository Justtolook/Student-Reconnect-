<?php
require_once 'Controller.php';
require_once 'app/frontend/models/RegisterModel.php';
require_once 'app/frontend/models/LoginModel.php';

class AuthController extends Controller {
    public function login() {
        $loginModel = new LoginModel();
        return $this->render('login', ['model' => $loginModel]);
    }

    public function handleLogin(Request $request) {
        $loginModel = new LoginModel();
        $loginModel->loadData($request->getBody());

        if($loginModel->validate()) {
            $user = $loginModel->login();
            if($user) {
                $_SESSION['user'] = $user; //is this secure?
                Application::$app->response->redirect("?t=frontend&request=profile");
                return;
            }
        }
        $loginModel->addError("password", Model::RULE_WRONG_PASSWORD);
        return $this->render('login', ['model' => $loginModel]);
    }

    //TODO: is it good to place it here or better in a middleware?
    public function checkLogin() {
        if(isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    public function register(Request $request) {
        $registerModel = new RegisterModel();
        return $this->render('register', ['model' => $registerModel]);
    }

    public function handleRegistration(Request $request) {
        $registerModel = new RegisterModel();
        $registerModel->loadData($request->getBody());

        if($registerModel->validate() && $registerModel->register()) {
            Application::$app->response->redirect("?t=frontend&request=login"); //new (better?) option to redirect TODO
            return;
            //return $this->render('login');
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