<?php
require_once 'Model.php';

class UserMatchModel extends Model {
    public int $id_user;
    public string $firstname;
    public string $lastname;
    public string $description;
    public Database $db;

    public function rules() : array {
        return [];
    }

    public function __construct() {
        $this->db = new Database();
        $users = $this->loadData($this->fetchOneUser());
        if(is_array($users)) {
            foreach ($users as $key => $value) {
                echo "$key: $value <br>";
            }
        }

    }

    public function fetchOneUser() {
        $statement = $this->db->prepare('SELECT * FROM User WHERE id_user = 1');
        $statement->execute();
        $users = $statement->fetch();

        return $users;

    }


}