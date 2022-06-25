<?php
require_once 'model.php';

class UserModel extends Model {
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
        $this->description = "";
        /*$users = $this->loadData($this->fetchUserByID());
        if(is_array($users)) {
            foreach ($users as $key => $value) {
                echo "$key: $value <br>";
            }
        }*/

    }

    public function fetchUserByID(int $id) {
        $statement = $this->db->prepare('SELECT * FROM User WHERE id_user = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch();
    }
}