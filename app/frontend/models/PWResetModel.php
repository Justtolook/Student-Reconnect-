<?php
require_once 'Model.php';
require_once 'Database.php';

class PWResetModel extends Model {
    public Database $db;
    public string $email;
    public string $newpassword;
    public string $passwordrepeat;
    public int $verifcode;
    public int $enteredcode;
    public bool $success = false;

    public function __construct() {
        $this->db = new Database();
    }

    public function rules(): array {
        return [
            //'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, self::RULE_EMAIL_UNI],
            'enteredcode' => [self::RULE_REQUIRED],
            'newpassword' => [self::RULE_REQUIRED],
            'passwordrepeat' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'newpassword']],
        ];
    }


    public function resetPassword() {
        if ($this->enteredcode == $this->verifcode) {
            $this->newpassword = password_hash($this->newpassword, PASSWORD_DEFAULT);
            $statement = $this->db->prepare('UPDATE user SET password = :password WHERE email = :email');
            $statement->bindValue(':password', $this->newpassword);
            $statement->bindValue(':email', $this->email);
            $this->success = $statement->execute();
            return $this->success;
        }else {
            exit;               // TO DO error handling
        }
    }

    /**
     * @return bool
     * check if the verification code is set in the session
     */
    public function isVerifCodeSet() {
        return isset($_SESSION['verifcode']);
    }

    /**
     * @param int $verifcodeInput
     * @return bool
     * check if the verification code is correct
     */
    public function isVerifCodeCorrect(int $verifcodeInput) {
        return $verifcodeInput == $_SESSION['verifcode'];
    }

    /**
     * @return void
     * load the verification code from the session
     */
    public function loadVerifCode() {
        $this->verifcode = $_SESSION['verifcode']['code'];
        $this->email = $_SESSION['verifcode']['email'];
    }
}
?>