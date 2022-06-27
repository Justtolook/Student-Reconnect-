<?php
require_once 'Model.php';
require_once 'Database.php';

class LoginModel extends Model {
    public Database $db;
    public string $email;
    public string $password;
    public int $id_role; //0 = guest, 1 = user, 2 = moderator, 3 = admin

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