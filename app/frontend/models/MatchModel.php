<?php
require_once 'Model.php';

class MatchModel extends Model {
    public Database $db;
    public int $id_myself;
    public array $matches = []; //array of userId the loggedin user matched with

    public function __construct(int $id_myself) {
        $this->db = new Database();
        $this->id_myself = $id_myself;
        $this->fetchMatches();
    }

    public function rules() : array {
        return [];
    }

    public function fetchMatches() {
        $statement = $this->db->prepare('SELECT * FROM matches WHERE id_User_1 = :id_myself OR id_User_2 = :id_myself');
        $statement->bindValue(':id_myself', $this->id_myself);
        $statement->execute();
        foreach($statement->fetchAll() as $item) {
            if ($item['id_User_1'] == $this->id_myself) {
                $this->matches[] = $item['id_User_2'];
            } else {
                $this->matches[] = $item['id_User_1'];
            }
        }
    }

    /**
     * @param int $id_user
     * @return bool
     */
    public function isMatchedWith(int $id_user) : bool {
        return in_array($id_user, $this->matches);
    }

    /**
     * @param int $id_user
     * @return bool
     * create a match between the loggedin user and the user with the given id
     */
    public function createMatch(int $id_user) : bool {
        $statement = $this->db->prepare('INSERT INTO matches (id_User_1, id_User_2, timestamp, notificationRead) VALUES (:id_myself, :id_user, :timestamp, :notificationRead)');
        $statement->bindValue(':id_myself', $this->id_myself);
        $statement->bindValue(':id_user', $id_user);
        $statement->bindValue(':timestamp', date('Y-m-d'));
        $statement->bindValue(':notificationRead', 0);
        return $statement->execute();
    }



}