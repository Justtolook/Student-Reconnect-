<?php
require_once 'Controller.php';
require_once 'app/frontend/models/UserMatchModel.php';
require_once 'app/frontend/models/UserModel.php';
require_once 'app/frontend/models/HasInterestModel.php';
require_once 'Database.php';

class MatchingController extends Controller {
    public UserModel $UserMyself;
    public UserMatchModel $UserMatchModel;
    public array $UserAll = [];
    public HasInterestModel $hasInterestModel;

    public function __construct() {
        /**
         * check if user is logged in. If they are not, user will be redirected to the login page
         */
        if(!$this->isLoggedIn()) Application::$app->response->redirect("?t=frontend&request=login");
        $this->UserMyself = new UserModel();
        $this->UserMatchModel = new UserMatchModel();
        $this->hasInterestModel = new HasInterestModel();
    }

    /**
     * @return void
     * fetches User data for logged in user and saves it in the UserModel $UserMyself
     */
    public function fetchMyself() {
        $temp = $this->UserMatchModel->fetchUserByID($_SESSION['user']['id_user']);
        $this->UserMyself->loadData($temp);
    }

    /**
     * @return void
     * fetches all users except the logged in user and creates a UserModel for each user
     * and stores them in the array $UserALl
     */
    public function fetchAllUser() {
        $temp_all = $this->UserMatchModel->fetchAllUser($_SESSION['user']['id_user']);
        foreach($temp_all as $user) {
            //echo "<pre>";
            //var_dump($user);
            $this->UserAll[$user['id_user']] = new UserModel();
            $this->UserAll[$user['id_user']] ->loadData($user);
        }
        //echo "<pre>";
        //var_dump($this->UserAll);

    }

    /**
     * @return void
     * Adds all interest id's for all users incl. the logged in user
     */
    public function addAllInterestsToUsers() {
        $this->hasInterestModel->fetchAllHasInterests();
        foreach ($this->UserAll as $user) {
            $user->interests = $this->hasInterestModel->getInterestsForUserID($user->id_user);
        }
        $this->UserMyself->interests = $this->hasInterestModel->getInterestsForUserID($this->UserMyself->id_user);
    }



    public function matching() {

        //$userMatchModel = new UserMatchModel();
        $this->fetchMyself();
        $this->fetchAllUser();
        $this->addAllInterestsToUsers();
        return $this->render('matching', ['model' => $this->UserMyself]);
    }

    //API function to get a profile in json format to render it in the browser with javascript?

    



}