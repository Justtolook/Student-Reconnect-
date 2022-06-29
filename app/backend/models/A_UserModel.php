<?php
require_once 'Model.php';

class A_UserModel extends Model {
    public int $id_user;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $gender;
    public $birthdate;
    public $image;
    public string $description = "";
    public int $scoreHost = 0;
    public int $scoreAttendee = 0;
    public int $id_role = 0;

    public function rules(): array {
        return [];
    }
}