<?php
require_once 'Model.php';
require_once 'Database.php';

class OwnEventsModel extends Model {
    public Database $db;
    public int $id_user;

    public function __construct() {
        $this->db = new Database();
        $this->id_user = $_SESSION['user']['id_user'];
    }

    public function getOwnEventIDs() {
        $statement = $this->db->prepare("SELECT id_Event FROM Event WHERE id_userCreator = :id_user");
        $statement->bindValue(':id_user', $this->id_user);
        $statement->execute();

        return $statement->fetch();
    }

    public function getEventInfoByEventID($eventID) {
        $statement = $this->db->prepare("SELECT name, description, numberAttendees, eventDate, roughlocation, exactlocation FROM  Event WHERE id_Event = :eventID");
        $statement->bindValue(':eventID', $eventID);
        $statement->execute();

        return $statement->fetch();
    }
}