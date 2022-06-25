<?php
require_once 'Model.php';

class MatchingInstanceModel extends Model {
    public array $matchingInstances;
    public int $UserIDMyself;
    public Database $db;

    public function __construct(int $UserIDMyself) {
        $this->db = new Database();
        $this->UserIDMyself = $UserIDMyself;
    }

    /**
     * @return void
     * fetches all matchingInstances from the matching_instances table for the given UserID
     * and saves them in $matchingInstances
     */

    public function fetchAllMatchingInstancesForUser() {
        $statement = $this->db->prepare('SELECT id_user_given, id_user_received, score  FROM matching_instance WHERE id_user_given = :id_myself');
        $statement->bindValue(':id_myself', $this->UserIDMyself);
        $statement->execute();
        $this->matchingInstances = $statement->fetchAll();
    }

    public function rules() : array {
        return [];
    }

    /**
     * @param int $UserID, int $score
     * @return void
     * adds a matchingInstance to the matching_instances table
     */
    public function addMatchingInstance(int $UserIDReceived, int $score)
    {
        $statement = $this->db->prepare('INSERT INTO matching_instance (id_user_given, id_user_received, score) VALUES (:id_myself, :id_user_received, :score)');
        $statement->bindValue(':id_myself', $this->UserIDMyself);
        $statement->bindValue(':id_user_received', $UserIDReceived);
        $statement->bindValue(':score', $score);
        $statement->execute();
    }

}