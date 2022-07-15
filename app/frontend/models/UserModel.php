<?php
require_once 'Model.php';

class UserModel extends Model {
    public int $id_user;
    public string $firstname;
    public string $lastname;
    public string $description;
    public string $gender;
    public array $interests;
    public array $matchingInstancesOld = []; //format [userID => score]
    public int $interestOverlapScore;

    public function rules() : array {
        return [];
    }

    public function __construct() {
        $this->description = "";
    }

    public function getUserById($id_user) : UserModel {
        $db = new Database();
        $statement = $db->prepare('SELECT * FROM user WHERE id_user = :id_user');
        $statement->bindValue(':id_user', $id_user);
        $statement->execute();
        $user = $statement->fetch();
        $this->loadData($user);
        return $this;
    }
}