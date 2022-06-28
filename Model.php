<?php

require_once 'Database.php';
/**
 * based on https://github.com/thecodeholic/tc-php-mvc-core
 */

abstract class Model {
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_EMAIL_UNI = 'email_uni';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_WRONG_PASSWORD ='password_incorrect';
    public const RULE_EMAIL_UNIQUE = 'email_unique';


    /**
     * @param $data -> e.g. a db statement result from SELECT
     * @return void -> attributes will be defined in the model object
     *
     * it is important to name the attributes in the specific model class exactly like in the db
     */
    public function loadData($data) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                if(!is_null($value)) $this->{$key} = $value;
            }
        }
    }
        
    public function checkEmailNotUnique(string $email) {
        $db = new Database;
        $statement = $db->prepare("SELECT * FROM user WHERE email = :email");
        $statement->bindValue(':email', $email);
        $statement->execute();
        while ($row = $statement->fetch()) {
            if (!empty($row['email'])) {
                return true;
            }else {
                return false;
            }
        }
    }

    abstract public function rules(): array;

    public array $errors = [];

    public function validate() {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if(!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_EMAIL_UNI && !strpos($value, "@stud.uni-bamberg.de")) {
                    //check $value if "@stud.uni-bamberg.de" string is in it
                    $this->addError($attribute, self::RULE_EMAIL_UNI);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, ['min' => $rule['min']]);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, ['max' => $rule['max']]);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, ['match' => $rule['match']]);
                }
                if ($ruleName === self::RULE_EMAIL_UNIQUE && $this->checkEmailNotUnique($value)) {
                    $this->addError($attribute, self::RULE_EMAIL_UNIQUE);
                }
            }
        }
        return empty($this->errors);
    }

    public function addError(string $attribute, string $rule, $params = []) {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function addErrorManual(string $attribute, string $errorMsg) {
        $this->errors[$attribute][] = $errorMsg;
    }

    public function errorMessages() {
        return [
            self::RULE_REQUIRED => 'Dieses Feld ist ein Pflichfeld.',
            self::RULE_EMAIL => 'Bitte geben sie eine gültige E-Mail Adresse an.',
            self::RULE_EMAIL_UNI => 'Sie müssen eine gültige E-Mail Adresse der Uni Bamberg verwenden.',
            self::RULE_MIN => 'Die minimale Länge dieses Feldes muss {min} sein.',
            self::RULE_MAX => 'Die maximale Länge dieses Feldes muss {max} sein.',
            self::RULE_MATCH => 'Dieses Feld muss {match} entsprechen.',
            self::RULE_WRONG_PASSWORD => 'Das Passwort ist falsch. Bitte versuchen Sie es erneut.',
            self::RULE_EMAIL_UNIQUE => 'Diese E-Mail Adresse wird bereits verwendet.'
        ];
    }

    /**
     * checks if there is an error for the specific attribute in the model
     * @param string $attribute
     * @return false|mixed
     */
    public function hasError(string $attribute) {
        return $this->errors[$attribute] ?? false;
    }

    public function getError(string $attribute) {
        return $this->errors[$attribute][0] ?? '';
    }

}
?>