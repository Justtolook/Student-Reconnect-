<?php
require_once 'Controller.php';
require_once 'app/frontend/models/UserMatchModel.php';
require_once 'app/frontend/models/UserModel.php';
require_once 'app/frontend/models/HasInterestModel.php';
require_once 'app/frontend/models/MatchingInstanceModel.php';
require_once 'app/frontend/models/InterestModel.php';
require_once 'app/frontend/models/MatchModel.php';
require_once 'Database.php';

class MatchingController extends Controller {
    public int $id_myself;
    public UserModel $UserMyself;
    public UserMatchModel $UserMatchModel;
    public array $UserAllBase = [];
    public array $UserAll = [];
    public HasInterestModel $hasInterestModel;
    public MatchingInstanceModel $matchingInstanceModel;
    public InterestModel $interestModel;
    public MatchModel $matchModel;
    public array $interestFilter = []; //array with their id's
    public bool $flag_noInterestOverlaps = false;

    public function __construct() {
        /**
         * check if user is logged in. If they are not, user will be redirected to the login page
         */
        if(!$this->isLoggedIn()) Application::$app->response->redirect("?t=frontend&request=login");
        $this->id_myself = $_SESSION['user']['id_user'];
        $this->UserMyself = new UserModel();
        $this->UserMatchModel = new UserMatchModel();
        $this->hasInterestModel = new HasInterestModel();
        $this->matchingInstanceModel = new MatchingInstanceModel($this->id_myself);
        $this->interestModel = new InterestModel();
        $this->matchModel = new MatchModel($this->id_myself);

        //$userMatchModel = new UserMatchModel();
        $this->fetchMyself();
        $this->fetchAllUser();
        $this->addAllInterestsToUsers();
        $this->fetchMatchingInstances();
        $this->deleteOldMatchesFromUserList();

        $this->interestModel->fetchAllInterests();
    }

    /**
     * @return string
     * standard function to render the view
     */
    public function matching() {
        $this->countInterestOverlap();
        //$this->printSortedUserList();
        $this->deleteUsersWithNoInterestOverlap();
        return $this->renderRandomUser();
    }

    /**
     * @return void
     * method to set custom interest filters to filter $UserAll array
     */
    public function filter() {
        $this->interestFilter = [];
        //check if $_Session['interestFilter'] is empty
        if(empty($_POST['interests'])) {
            //add all interests to the interestFilter
            foreach($this->interestModel->interests as $id => $interest) {
                array_push($this->interestFilter, $id);
            }
        }
        else {
            foreach($_POST['interests'] as $interest) {
                array_push($this->interestFilter, $this->interestModel->getInterestID($interest));
            };
            //save the interestFilter in the session
            $this->saveInterestFilter();
        }


        $this->countInterestOverlap();
        //$this->printSortedUserList();
        $this->deleteUsersWithNoInterestOverlap();
        return $this->renderRandomUser();
    }

    /**
     * @return void
     * reset the interest filter to original interests of the user
     */
    public function resetFilter()
    {
        $this->deleteInterestFilter();
        $this->setOriginalInterests();
        Application::$app->response->redirect("?t=frontend&request=matching");
    }

    /**
     * @return void
     * clear the interest filter to all interests
     */
    public function clearFilter() {
        $this->deleteInterestFilter();
        $this->interestFilter = [];
        foreach($this->interestModel->interests as $id => $interest) {
            array_push($this->interestFilter, $id);
        }
        $this->saveInterestFilter();
        Application::$app->response->redirect("?t=frontend&request=matching");
    }



    /**
     * @return void
     * save the interestFilter in the session
     * this is used to filter the users by their interests
     */
    public function saveInterestFilter() {
        $_SESSION['interestFilter'] = $this->interestFilter;
    }

    /**
     * @return void
     * fetch the interestFilter from the session
     * this is used to filter the users by their interests
     */
    public function fetchInterestFilter() {
        $this->interestFilter = $_SESSION['interestFilter'];
    }

    /**
     * @return void
     * delete the interestFilter from the session
     * this is used to filter the users by their interests
     */
    public function deleteInterestFilter() {
        unset($_SESSION['interestFilter']);
    }

    /**
     * @return bool
     * check if the interests are set in the session
     */
    public function isInterestFilterSet() : bool {
        return isset($_SESSION['interestFilter']);
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
            $this->UserAllBase[$user['id_user']] = new UserModel();
            $this->UserAllBase[$user['id_user']] ->loadData($user);
            $this->UserAll = $this->UserAllBase;
        }
        //echo "<pre>";
        //var_dump($this->UserAll);

    }

    /**
     * @return void
     * sets the original interests of the logged in user as interestFilter
     */
    public function setOriginalInterests() {
        $this->interestFilter = $this->UserMyself->interests;
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
        //TODO: only add interests to the filter if no interests are set in the session
        if(!$this->isInterestFilterSet()) {
            $this->interestFilter = $this->hasInterestModel->getInterestsForUserID($this->UserMyself->id_user);
        }
        else {
            $this->fetchInterestFilter();
        }
    }

    /**
     * @return void
     * adds all matching instances to the UserModel $UserMyself
     */
    public function fetchMatchingInstances() {
        $this->matchingInstanceModel->fetchAllMatchingInstancesForUser();
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
                //echo "delete user from m: ".$user->id_user."<br>";
                unset($this->UserAll[$user->id_user]);
                unset($this->UserAllBase[$user->id_user]);
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
    /*public function countInterestOverlap() {
        foreach($this->UserAll as $user) {
            $user->interestOverlapScore = 0;
            foreach($this->UserMyself->interests as $interest) {
                if(in_array($interest, $user->interests)) {
                    $user->interestOverlapScore++;
                }
            }
        }
    }*/

    /**
     * @return void
     * count the number of interest overlaps between $interestFilter and all users in the UserAll array and saves it in $UserAll['id_user']->interestOverlapScore
     */
    public function countInterestOverlap() {
        foreach($this->UserAll as $user) {
            $user->interestOverlapScore = 0;
            foreach($this->interestFilter as $interest) {
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
        if(count($this->UserAll) == 0) {
            //echo "No users found";
            $this->flag_noInterestOverlaps = true;
            $this->UserAll = $this->UserAllBase;
        }
    }

    /**
     * @return string
     * selects a random user from the UserAll array and render the matching view with that user
     */
    public function renderRandomUser() {
        $randomUser = array_rand($this->UserAll);
        return $this->render("matching", ["model" => $this->UserAll[$randomUser], "interestModel" => $this->interestModel, "filter" => $this->interestFilter, "flag_noInterestOverlaps" => $this->flag_noInterestOverlaps]);
    }

    /**
     * @param int $id_user
     * @return string
     * render the matching view with the user with the id_user $id_user
     * debug only
     */
    public function renderUserByID($id_user) {
        return $this->render("matching", ["model" => $this->UserAll[$id_user], "interestModel" => $this->interestModel]);
    }

    /**
     * @return string
     * renders the machting instances for logged in user
     * only debug function
     */
    public function printMatchingInstances() {
        echo "<pre>";
        var_dump($this->UserMyself->matchingInstancesOld);
    }





    //API function to get a profile in json format to render it in the browser with javascript?

    /**
     * @return
     * add a positive matching instance to the database
     */
    public function addMatchingInstancePositive() {
        $userID = $_POST['id_user'];
        $this->matchingInstanceModel->addMatchingInstance($userID, 1);
        if($this->matchingInstanceModel->checkForPositiveMatchingScore($userID)) {
            $this->matchModel->createMatch($userID);
        }
        Application::$app->response->redirect("?t=frontend&request=matching");
    }

    /**
     * @return
     * add a negative matching instance to the database
     */
    public function addMatchingInstanceNegative() {
        $this->matchingInstanceModel->addMatchingInstance($_POST['id_user'], 0);
        Application::$app->response->redirect("?t=frontend&request=matching");
    }





}