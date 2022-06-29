<?php
require_once 'Model.php';
require_once 'Database.php';
require_once 'app/backend/models/UserModel.php';

class UserAdministrationModel extends Model {
    public array $users;
    public Database $db;

    public function __construct() {
        $this->db = new Database();
        $this->createUserModels($this->getUsers());
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
            $userModel = new UserModel();
            $userModel->loadData($user);
            $this->users[] = $userModel;
        }
    }


}