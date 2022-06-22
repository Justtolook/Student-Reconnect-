<?php
require_once 'Model.php';
require_once 'Database.php';

class PWResetModel extends Model {
    public Database $db;
    public string $email;
    public string $password;
    public string $passwordrepeat;
    public int $verifcode;
    public int $enteredcode;

    public function __construct() {
        $this->db = new Database();
        $this->verifcode = rand(100000,999999);
    }

    public function rules(): array {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, self::RULE_EMAIL_UNI],
            'password' => [self::RULE_REQUIRED],
            'passwordrepeat' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function sendEmail() {
        $to = $this->email;
        $subject = "Zurücksetzen Ihres Passworts";
        $content = "Ihr Verifizierungscode zum Zurücksetzen Ihres Passworts lautet: $this->verifcode";
        $header = "From: studreconn@noreply.com" . "\r\n";

        mail($to, $subject, $content, $header)
    }

    public function resetPassword() {
        if ($enteredcode == $verifcode) {
            $statement = $this->db->prepare('UPDATE Users SET password = :password WHERE email = :email');
            $statement->bindValue(':password', $this->password);
            $statement->bindValue(':email', $this->email);
            $statement->execute();
        }else {
            exit;               // TO DO error handling
        }

    }
}
?>