<?php
require_once 'Model.php';
require_once 'Database.php';

class LoginModel extends Model {
    public Database $db;
    public string $email;
    public string $password;

    public function __construct() {
        $this->db = new Database();
    }

    public function rules(): array {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, self::RULE_EMAIL_UNI],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    public function login() {
        $statement = $this->db->prepare('SELECT * FROM User WHERE email = :email');
        $statement->bindValue(':email', $this->email);
        $statement->execute();
        $user = $statement->fetch();
        if ($user && password_verify($this->password, $user['password'])) {
            return $user;
        }
        return false;
    }


    




}