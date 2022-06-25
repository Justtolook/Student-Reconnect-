<?php
require_once 'Controller.php';
require_once 'app/frontend/models/UserMatchModel.php';
require_once 'app/frontend/models/UserModel.php';
require_once 'app/frontend/models/HasInterestModel.php';
require_once 'app/frontend/models/MatchingInstanceModel.php';
require_once 'Database.php';

class MatchingController extends Controller {
    public UserModel $UserMyself;
    public UserMatchModel $UserMatchModel;
    public array $UserAll = [];
    public HasInterestModel $hasInterestModel;
    public MatchingInstanceModel $matchingInstanceModel;

    public function __construct() {
        /**
         * check if user is logged in. If they are not, user will be redirected to the login page
         */
        if(!$this->isLoggedIn()) Application::$app->response->redirect("?t=frontend&request=login");
        $this->UserMyself = new UserModel();
        $this->UserMatchModel = new UserMatchModel();
        $this->hasInterestModel = new HasInterestModel();
        $this->matchingInstanceModel = new MatchingInstanceModel();
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

    /**
     * @return void
     * adds all matching instances to the UserModel $UserMyself
     */
    public function fetchMatchingInstances() {
        $this->matchingInstanceModel->fetchAllMatchingInstancesForUser($this->UserMyself->id_user);
        foreach($this->matchingInstanceModel->matchingInstances as $matchingInstance) {
            $this->UserMyself->matchingInstancesOld[$matchingInstance['id_user_received']] = $matchingInstance['score'];
        }
    }

    /**
     * @return void
     * removes all user from the UserAll array that have been rated by the logged in user before
     */
    public function deleteOldMatchesFromUserList() {
        foreach($this->UserAll as $user) {
            if(isset($this->UserMyself->matchingInstancesOld[$user->id_user])) {
                unset($this->UserAll[$user->id_user]);
            }
        }
    }

    /**
     * @return void
     * prints the number of users in the UserAll array
     */
    public function printUserListCount() {
        echo "UserListCount: " . count($this->UserAll);
    }

    /**
     * @return void
     * count the number of interest overlaps between $UserMyself and all users in the UserAll array and saves it in $UserAll['id_user']->interestOverlapScore
     */
    public function countInterestOverlap() {
        foreach($this->UserAll as $user) {
            $user->interestOverlapScore = 0;
            foreach($this->UserMyself->interests as $interest) {
                if(in_array($interest, $user->interests)) {
                    $user->interestOverlapScore++;
                }
            }
        }
    }

    /**
     * @return void
     * sorts the UserAll array descending by the interestOverlapScore and prints it
     */
    public function printSortedUserList() {
        uasort($this->UserAll, function($a, $b) {
            return $b->interestOverlapScore - $a->interestOverlapScore;
        });
        echo "<pre>";
        var_dump($this->UserAll);
    }

    /**
     * @return void
     * remove all Users from the UserAll array that have a interestOverlapScore of 0
     */
    public function deleteUsersWithNoInterestOverlap() {
        foreach($this->UserAll as $user) {
            if($user->interestOverlapScore == 0) {
                unset($this->UserAll[$user->id_user]);
            }
        }
    }

    /**
     * @return string
     * selects a random user from the UserAll array and render the matching view with that user
     */
    public function renderRandomUser() {
        $randomUser = array_rand($this->UserAll);
        return $this->render("matching", ["model" => $this->UserAll[$randomUser]]);
    }



    public function matching() {

        //$userMatchModel = new UserMatchModel();
        $this->fetchMyself();
        $this->fetchAllUser();
        $this->addAllInterestsToUsers();
        $this->fetchMatchingInstances();
        $this->deleteOldMatchesFromUserList();
        $this->countInterestOverlap();
        //$this->printSortedUserList();
        $this->deleteUsersWithNoInterestOverlap();

        return $this->renderRandomUser();
    }

    //API function to get a profile in json format to render it in the browser with javascript?

    



}