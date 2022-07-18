<?php
require_once 'Controller.php';
require_once 'app/frontend/models/RegisterModel.php';
require_once 'app/frontend/models/LoginModel.php';
require_once 'app/frontend/models/PWResetModel.php';
require_once 'app/frontend/models/PWResetEmailModel.php';


class AuthController extends Controller {

    public function __construct() {
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
        $temp = $request->getBody();
        $gender = $temp['gender'];
        $temp['gender'] = $gender[0];
        $registerModel->loadData($temp);
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

    /**
     * @param Request $request
     * @return string
     * Function will try to send an email with an password reset verification code to the given email address.
     *
     */

    public function handlePWResetEmail(Request $request) {
        $PWResetEmailModel = new PWResetEmailModel();
        $PWResetEmailModel->loadData($request->getBody());
        if($PWResetEmailModel->validate()) {
            if($PWResetEmailModel->printVerifCode() && $PWResetEmailModel->sendEmail()) { //to be changed to sendMail() TODO if mail is working
                $PWResetEmailModel->saveVerificationCode(); //save verification code in session variable
                return $this->render('pwreset', ['model' => $PWResetEmailModel]);
            }
            return $this->render("error_email_not_sent");
        }
        return $this->render("error_email_validation");
    }

    public function handlePWReset(Request $request) {
        $PWResetModel = new PWResetModel();
        if(!$PWResetModel->isVerifCodeSet()) {
            return $this->render("error_verifcode_not_set");
        }
        $PWResetModel->loadData($request->getBody());
        if(!$PWResetModel->validate()) return $this->render("pwreset", ['model' => $PWResetModel]);
        $PWResetModel->loadVerifCode();
        echo $PWResetModel->verifcode;
        if($PWResetModel->resetPassword()) return $this->render("pwreset", ['model' => $PWResetModel]);
        else return $this->render("pwreset", ['model' => $PWResetModel]);

    }

}