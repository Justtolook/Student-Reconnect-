<?php
require_once 'Model.php';

class MatchingInstanceModel extends Model {
    public array $matchingInstances;
    public Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * @return void
     * fetches all matchingInstances from the matching_instances table for the given UserID
     * and saves them in $matchingInstances
     */

    public function fetchAllMatchingInstancesForUser(int $UserID) {
        $statement = $this->db->prepare('SELECT id_user_given, id_user_received, score  FROM matching_instance WHERE id_user_given = :id_myself');
        $statement->bindValue(':id_myself', $UserID);
        $statement->execute();
        $this->matchingInstances = $statement->fetchAll();
    }

    public function rules() : array {
        return [];
    }
}