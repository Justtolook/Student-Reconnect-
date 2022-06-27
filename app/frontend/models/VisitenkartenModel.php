<?php
require_once 'model.php';

class VisitenkartenModel extends Model{
    public $id_user;
    public $firstname;
    public $lastname;
    public $description;
    public $contactInformation;
    public $interests;  // format id der interessen oder array $id => $name
    public Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function rules() : array {
        return [];
    }

    /**
     * @return void
     * set the attributes of the model from the query resutls
     */

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