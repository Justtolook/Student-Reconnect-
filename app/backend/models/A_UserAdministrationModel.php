<?php
require_once 'Model.php';
require_once 'Database.php';
require_once 'app/backend/models/A_UserModel.php';
require_once 'app/backend/models/A_HasInterestModel.php';

class A_UserAdministrationModel extends Model {
    public array $users;
    public A_HasInterestModel $hasInterestModel;
    public Database $db;

    public function __construct() {
        $this->db = new Database();
        $this->createUserModels($this->getUsers());
        $this->hasInterestModel = new A_HasInterestModel();
        $this->hasInterestModel->fetchAllHasInterests();
        $this->addInterestsToUsers();
    }

    public function rules(): array {
        return [];
    }

    public function getUsers() {
        $statement = $this->db->prepare('SELECT * FROM user');
        $statement->execute();
        return $statement->fetchAll();
    }

    /**
     * method to create UserModel objects from all the results of the database query
     */
    public function createUserModels($userQuery) {
        foreach($userQuery as $user) {
            $userModel = new A_UserModel();
            $userModel->loadData($user);
            $this->users[] = $userModel;
        }
    }

    /**
     * return the UserModel object for the given id from the users array
     */
    public function getUserById($id_user) {
        //$uid = $request->getBody()['uid'];
        foreach ($this->users as $user) {
            if ($user->id_user == $id_user) {
                return $user;
            }
        }
    }

    /*
     *
     * @return void
     * adds all selected interests to the $interests array for all users in the users array
     */
    public function addInterestsToUsers() {
        foreach ($this->users as $user) {
            $user->interests = $this->hasInterestModel->getInterestsForUserID($user->id_user);
        }
    }






}