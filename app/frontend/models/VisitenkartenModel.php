<?php
require_once 'Model.php';
require_once 'app/frontend/models/HasInterestModel.php';

class VisitenkartenModel extends Model{
    public $id_user;
    public $firstname;
    public $lastname;
    public $description;
    public $contactInformation;
    public array $interests;  // format id der interessen oder array $id => $name
    public HasInterestModel $hasInterestModel;
    public Database $db;

    public function __construct(int $id_user) {
        $this->db = new Database();
        $this->loadData($this->getVisitenkartenByUserID($id_user));
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
    public function getVisitenkartenByUserID(int $userID) {
        $sql = "SELECT id_user, firstname, lastname, description, contactInformation FROM user WHERE id_user = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $userID);
        $stmt->execute();
        return $stmt->fetch();
    }
}