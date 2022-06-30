<?php
require_once 'Model.php';

class A_InterestModel extends Model {
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

    /**
     * @param string $name
     * @return int id of the interest with the given name
     *
     * returns the id of the interest for the given name
     */
    public function getInterestID(string $name) {
        foreach ($this->interests as $id => $interest) {
            if ($interest == $name) return $id;
        }
        return -1;
    }

    /**
     * @param int $id_interest
     * @return [int] => [string]
     * returns the interest with the given id
     */
    public function getInterestById(int $id_interest) {
        $interest = ['id_interest' => $id_interest, 'name' => $this->getInterestName($id_interest)];
        return $interest;
    }

    /**
     * @param int $id_interest
     * @return void
     * saves the interest with the given id
     */
    public function save(int $id_interest) {
        $statement = $this->db->prepare('UPDATE interest SET name = :name WHERE id_interest = :id_interest');
        $statement->bindValue(':id_interest', $id_interest);
        $statement->bindValue(':name', $this->getInterestName($id_interest));
        $statement->execute();
    }

    /**
     * @param string $name
     * @return void
     * adds a new interest with the given name
     */
    public function add(string $name) {
        $statement = $this->db->prepare('INSERT INTO interest (name) VALUES (:name)');
        $statement->bindValue(':name', $name);
        $statement->execute();
    }

    /**
     * @param int $id_interest
     * @return void
     * deletes the interest with the given id
     */
    public function delete(int $id_interest) {
        $statement = $this->db->prepare('DELETE FROM interest WHERE id_interest = :id_interest');
        $statement->bindValue(':id_interest', $id_interest);
        $statement->execute();
    }
}