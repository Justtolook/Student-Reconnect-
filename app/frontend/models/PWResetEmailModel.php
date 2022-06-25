<?php
require_once 'model.php';
require_once 'Database.php';

class PWResetEmailModel extends model {
    public Database $db;
    public string $email;
    public int $verifcode;

    public function __construct() {
        $this->db = new Database();
        $this->verifcode = rand(100000,999999);
    }

    public function rules(): array {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, self::RULE_EMAIL_UNI], //Regel überprüfen ob email überhaupt existiert
        ];
    }

    public function sendEmail() {
        $to = $this->email;
        $subject = "Zurücksetzen Ihres Passworts";
        $content = "Ihr Verifizierungscode zum Zurücksetzen Ihres Passworts lautet: $this->verifcode";
        $header = "From: studreconn@noreply.com" . "\r\n";

        return mail($to, $subject, $content, $header);
    }

    public function saveVerificationCode() {
        $_SESSION['verifcode'] = $this->verifcode;
    }
}