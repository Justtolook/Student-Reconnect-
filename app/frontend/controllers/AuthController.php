<?php
require_once 'Controller.php';
class AuthController extends Controller {
    public function login() {
        return $this->render('login');
    }

    public function handleLogin(Request $request) {
        return 'handle submitted registration';
    }

    public function register(Request $request) {
        return $this->render('register');
    }

    public function handleRegistration() {

        return 'handle submitted registration';
    }

    public function pwReset() {
        return $this->render('pwreset');
    }

    public function handlePWReset(Request $request) {
        return 'handle submitted pwreset data';
    }
}