<?php
require_once 'model.php';

class UserModel extends Model {
    public int $id_user;
    public string $firstname;
    public string $lastname;
    public string $description;
    public string $gender;

    public function rules() : array {
        return [];
    }

    public function __construct() {
        $this->description = "";
    }
}