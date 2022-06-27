<?php
require_once 'Model.php';

class HasInterestModel extends Model {
    public array $hasInterests;
    public Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function rules() : array {
        return [];
    }

    /**
     * @return void
     * fetches all interests from the hasInterest table and saves them in $hasInterests
     */

    public function fetchAllHasInterests() {
        $statement = $this->db->prepare('SELECT * FROM hasInterest');
        $statement->execute();
        $this->hasInterests = $statement->fetchAll();
    }

    /**
     * return void
     * fetch only interests from hasInterest table for specific user
     */
    public function fetchInterestsForUserID(int $userID) {
        $sql = "SELECT * FROM hasInterest WHERE id_user = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':user_id', $userID);
        $stmt->execute();
        $this->hasInterests = $stmt->fetchAll();
    }

    /**
     * @param int $UserID
     * @return array of interests id's for the given UserID
     */
    public function getInterestsForUserID(int $UserID) {
        $interests = [];
        foreach($this->hasInterests as $item) {
            if($item['id_user'] == $UserID) array_push($interests, $item['id_interest']);
        }
        return $interests;
    }

}