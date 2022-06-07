<?php
require_once 'Controller.php';
require_once 'app/frontend/models/RegisterModel.php';

class AuthController extends Controller {
    public function login() {
        return $this->render('login');
    }

    public function handleLogin(Request $request) {
        return 'handle submitted registration';
    }

    public function register(Request $request) {
        $registerModel = new RegisterModel();
        return $this->render('register', ['model' => $registerModel]);
    }

    public function handleRegistration(Request $request) {
        $registerModel = new RegisterModel();
        $registerModel->loadData($request->getBody());

        if($registerModel->validate() && $registerModel->register()) {
            return $this->render('login');
        }
        //echo $this->render
        //echo "<pre>";
        //var_dump($registerModel->errors);
        //var_dump($registerModel);
        return $this->render('register', ['model' => $registerModel]);
    }

    public function pwReset() {
        return $this->render('pwreset');
    }

    public function handlePWReset(Request $request) {
        return 'handle submitted pwreset data';
    }
}