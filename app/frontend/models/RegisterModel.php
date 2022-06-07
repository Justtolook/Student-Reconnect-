<?php

require_once 'Model.php';

class RegisterModel extends Model {
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $passwordrepeat;
    public string $gender;
    public string $birthdate;

    public function rules(): array {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 2]],
            'passwordrepeat' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
            'gender' => [self::RULE_REQUIRED],
            'birthdate' => [self::RULE_REQUIRED],
        ];
    }

    public function register() {
        //TODO Push data into DB
        return true;
    }


}