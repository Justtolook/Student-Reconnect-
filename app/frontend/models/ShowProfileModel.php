<?php
require_once 'Model.php';
require_once 'Database.php';
require_once 'app/frontend/models/HasInterestModel.php';

class ShowProfileModel extends Model {
    public $id_user;
    public $firstname;
    public $lastname;
    public $description;
    public $gender;
    public $scoreAttendee;
    public $scoreHost;
    public $birthdate;
    public $contactInformation;
    public array $interests;  // format id der interessen oder array $id => $name
    public HasInterestModel $hasInterestModel;
    public Database $db;


    public function __construct(int $id_user) {
        $this->db = new Database();
        $this->loadData($this->getProfileDataByUserId($id_user));
        $this->hasInterestModel = new HasInterestModel();
        $this->hasInterestModel->fetchInterestsForUserID($id_user);
        $this->interests = $this->hasInterestModel->getInterestsForUserID($id_user);
    }

    
    public function rules() : array {
        return [];
    }

    /**
     * @param int $userID
     * @return sql result
     * get visitenkarten data for specific user by id
     */
    public function getProfileDataByUserId (int $userID){
        
        $sql = "SELECT id_user, firstname, lastname, description, gender,scoreHost, scoreAttendee, birthdate, contactInformation FROM user WHERE id_user = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $userID);
        $stmt->execute();
        
        return $stmt->fetch();
        
    }

    public function updateScoreHost() {
        $statement = $this->db->prepare('UPDATE user SET scoreHost = scoreHost + :scoreHost WHERE id_user = :id_user');
        $statement->bindValue(':scoreHost', $this->scoreHost);
        $statement->bindValue(':id_user', $this->id_user);
        return $statement->execute();
    }

    public function updateScoreAttendee() {
        $statement = $this->db->prepare('UPDATE user SET scoreAttendee = scoreAttendee + :scoreAttendee WHERE id_user = :id_user');
        $statement->bindValue(':scoreAttendee', $this->scoreAttendee);
        $statement->bindValue(':id_user', $this->id_user);
        return $statement->execute();
    }
}
?>