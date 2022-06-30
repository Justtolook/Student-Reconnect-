<?php
require_once 'Model.php';
require_once 'Database.php';
require_once 'HasInterestModel.php';

class EditProfileModel extends Model {
    public Database $db;
    public int $id_user;
    public string $firstname;
    public string $lastname;
    public string $description;
    public string $contactInformation;
    public array $interestsGiven;

    public function __construct() {
        $this->db = new Database();
        $this->id_user = $_SESSION['user']['id_user'];
    }

    public function rules(): array {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
        ];
    }

    public function saveChanges() {
        $statement = $this->db->prepare('UPDATE User SET   firstname = :firstname,
                                                            lastname = :lastname,
                                                            description = :description,
                                                            contactInformation = :contactInformation
                                                            WHERE id_user = :id_user');
        $statement->bindValue(':firstname', $this->firstname);
        $statement->bindValue(':lastname', $this->lastname);
        $statement->bindValue(':description', $this->description);
        $statement->bindValue(':contactInformation', $this->contactInformation);
        $statement->bindValue(':id_user', $this->id_user);
        $statement->execute();
        setInterestsForUserID($this->id_user, $this->interestsGiven);
    }
}
?>