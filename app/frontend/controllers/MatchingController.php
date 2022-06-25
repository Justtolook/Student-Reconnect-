<?php
require_once 'Controller.php';
require_once 'app/frontend/models/UserMatchModel.php';
require_once 'app/frontend/models/UserModel.php';
require_once 'Database.php';

class MatchingController extends Controller {
    public UserModel $UserMyself;
    public UserMatchModel $UserMatchModel;
    public array $UserAll;

    public function __construct() {
        /**
         * check if user is logged in. If they are not, user will be redirected to the login page
         */
        if(!$this->isLoggedIn()) Application::$app->response->redirect("?t=frontend&request=login");
        $this->UserMyself = new UserModel();
        $this->UserMatchModel = new UserMatchModel();
    }

    public function fetchMyself() {
        $temp = $this->UserMatchModel->fetchUserByID($_SESSION['user']['id_user']);
        $this->UserMyself->loadData($temp);
    }

    public function fetchAllUser() {
        $temp_all = $this->UserMatchModel->fetchAllUser($_SESSION['user']['id_user']);
        foreach($temp_all as $user) {
            //echo "<pre>";
            //var_dump($user['firstname']);
            $this->UserAll[$user['id_user']] = new UserModel();
            $this->UserAll[$user['id_user']]->loadData($user);
        }
        //echo "<pre>";
        //var_dump($this->UserAll);

    }



    public function matching() {

        //$userMatchModel = new UserMatchModel();
        $this->fetchMyself();
        $this->fetchAllUser();
        return $this->render('matching', ['model' => $this->UserMyself]);
    }

    //API function to get a profile in json format to render it in the browser with javascript?

    



}