<?php
require_once 'Model.php';

class UserMatchModel extends Model {
    public Database $db;

    public function rules() : array {
        return [];
    }

    public function __construct() {
        $this->db = new Database();
    }

    public function fetchOneUser() {
        $statement = $this->db->prepare('SELECT * FROM user WHERE id_user = 1');
        $statement->execute();
        $users = $statement->fetch();

        return $users;

    }

    public function fetchAllUser(int $id_myself) {
        $statement = $this->db->prepare('SELECT id_user, firstname, lastname, description, gender FROM user WHERE id_user != :id_myself');
        $statement->bindValue('id_myself', $id_myself);
        $statement->execute();
        return $statement->fetchall();
    }

    public function fetchUserByID(int $id) {
        $statement = $this->db->prepare('SELECT * FROM user WHERE id_user = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch();
    }


}