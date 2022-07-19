<?php
require_once 'Model.php';

class UserModel extends Model {
    public int $id_user;
    public string $firstname;
    public string $lastname;
    public string $description;
    public string $gender;
    public array $interests;
    public $birthdate;
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

    public function getUserNameByID($id_user) : String {
        $db = new Database();
        $statement = $db->prepare('SELECT firstname, lastname FROM user WHERE id_user = :id_user');
        $statement->bindValue(':id_user', $id_user);
        $statement->execute();
        $array = $statement->fetch();
        $firstname = $array['firstname'];
        $lastname = $array['lastname'];
        return $firstname . " " . $lastname;
    }

    public function delete() {
        $db = new Database();
        $statement = $db->prepare('DELETE FROM user WHERE id_user = :id_user');
        $statement->bindValue(':id_user', $this->id_user);
        $statement->execute();
        $statement = $db->prepare('DELETE FROM event WHERE id_userCreator = :id_user');
        $statement->bindValue(':id_user', $this->id_user);
        $statement->execute();
        $statement = $db->prepare('DELETE FROM eventSignOn WHERE id_User = :id_user');
        $statement->bindValue(':id_user', $this->id_user);
        $statement->execute();
        $statement = $db->prepare('DELETE FROM hasInterest WHERE id_user = :id_user');
        $statement->bindValue(':id_user', $this->id_user);
        $statement->execute();
        $statement = $db->prepare('DELETE FROM matches WHERE id_User_1 = :id_user OR id_User_2 = :id_user');
        $statement->bindValue(':id_user', $this->id_user);
        $statement->execute();
        $statement = $db->prepare('DELETE FROM matching_instance WHERE id_user_given = :id_user OR id_user_received = :id_user');
        $statement->bindValue(':id_user', $this->id_user);
        $statement->execute();
    }


}