<?php
require_once 'Controller.php';
require_once 'app/frontend/models/UserMatchModel.php';
require_once 'app/frontend/models/UserModel.php';
require_once 'Database.php';

class MatchingController extends Controller {
    public UserModel $UserMyself;
    public array $UserAll;

    public function __construct() {
        $this->UserMyself = new UserModel();
        /**
         * check if user is logged in. If they are not, user will be redirected to the login page
         */
        if(!$this->isLoggedIn()) Application::$app->response->redirect("?t=frontend&request=login");

    }

    public function fetchMyself() {

        $temp = $this->UserMyself->fetchUserByID($_SESSION['user']['id_user']);
        $this->UserMyself->loadData($temp);

    }



    public function matching() {

        //$userMatchModel = new UserMatchModel();
        $this->fetchMyself();
        return $this->render('matching', ['model' => $this->UserMyself]);
    }

    //API function to get a profile in json format to render it in the browser with javascript?

    



}