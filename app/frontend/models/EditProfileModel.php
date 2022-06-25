<?php
require_once 'Model.php';
require_once 'Database.php';

class EditProfileModel extends Model {
    public Database $db;
    public int $userid;
    public string $firstname;
    public string $lastname;
    public string $description;
    //public array $interests;
    //public array $properties;

    public function __construct() {
        $this->db = new Database();
    }

    public function rules(): array {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
        ];
    }

    public function saveChanges() {
        $statement = $this->db->prepare('UPDATE User SET   firstname = :firstname
                                                            lastname = :lastname
                                                            description = :description
                                                            /*interests = :interests
                                                            properties = :properties*/
                                                            WHERE id_user = :userid');
        $statement->bindValue(':firstname', $this->firstname);
        $statement->bindValue(':lastname', $this->lastname);
        $statement->bindValue(':description', $this->description);
        //$statement->bindValue(':interests', $this->interests);
        //$statement->bindValue(':properties', $this->properties);
        $statement->bindValue(':userid', $this->userid);
        $statement->execute();
    }
}
?>
 // TO DO: adapt interests and properties according to database structure