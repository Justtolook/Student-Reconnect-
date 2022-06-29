<?php

require_once 'Model.php';
require_once 'Database.php';

class RegisterModel extends Model {
    private Database $db;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $passwordrepeat;
    public string $gender;
    public string $birthdate;
    public int $id_role = 1;

    public function __construct() {
        $this->db = new Database();
    }

    public function rules(): array {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, self::RULE_EMAIL_UNI, self::RULE_EMAIL_UNIQUE],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 2]],
            'passwordrepeat' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
            'gender' => [self::RULE_REQUIRED],
            'birthdate' => [self::RULE_REQUIRED],
        ];
    }

    /**
     * Write the user registration data into the database
     * @return bool based on execution success
     */
    public function register() {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $statement = $this->db->prepare("INSERT INTO user (firstname, lastname, email, password, gender, birthdate, id_role) VALUES (:firstname, :lastname, :email, :password, :gender, :birthdate, :id_role)");
        $statement->bindValue(':firstname', $this->firstname);
        $statement->bindValue(':lastname', $this->lastname);
        $statement->bindValue(':password', $this->password);
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':password', $this->password);
        $statement->bindValue(':gender', $this->gender);
        $statement->bindValue(':birthdate', $this->birthdate);
        $statement->bindValue('id_role', $this->id_role);

        return $statement->execute();
    }
}
?>