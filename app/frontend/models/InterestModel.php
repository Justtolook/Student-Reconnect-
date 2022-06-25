<?php
require_once 'Model.php';

class InterestModel extends Model {
    public array $interests;
    public Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function rules() : array {
        return [];
    }

    /**
     * @return void
     * fetches all interests from the interest table and saves them in $interests
     */
    public function fetchAllInterests() {
        $statement = $this->db->prepare('SELECT * FROM interest');
        $statement->execute();
        foreach($statement->fetchAll() as $item) {
            $this->interests[$item['id_interest']] = $item['name'];
        }
    }

    /**
     * @param int $id_interest
     * @return string
     * returns the name of the interest with the given id
     */
    public function getInterestName(int $id_interest) {
        return $this->interests[$id_interest];
    }
}