<?php
require_once 'Model.php';
require_once 'Database.php';

class EventCreationModel extends Model {
    public Database $db;
    public string $name;
    public string $description;
    public string $eventDate;
    public string $roughlocation;
    public string $exactlocation;
    public string $dateCreated;
    public int $id_userCreator;
    public int $eventDate1;
    public int $dateCreated1;

    public function __construct() {
        $this->db = new Database();
        $this->id_userCreator = $_SESSION['user']['id_user'];
        $this->dateCreated = date('Y-m-d');
    }

    $eventDate1 = strtotime($eventDate);

    public function rules(): array {
        return [
            'name' => [self::RULE_REQUIRED],
            'description' => [self::RULE_REQUIRED],
            'eventDate' => [self::RULE_REQUIRED],
            'eventDate1' => [self::RULE_DATE],
            'roughlocation' => [self::RULE_REQUIRED],
            'exactlocation' => [self::RULE_REQUIRED],
        ];
    }

    public function createEvent() {
        $statement = $this->db->prepare("INSERT INTO user (name, description, eventDate, roughlocation, exactlocation, dateCreated, id_userCreator) VALUES (:name, :description, :eventDate, :roughlocation, :exactlocation, :dateCreated, :id_userCreator)");
        $statement->bindValue(':name', $this->name);
        $statement->bindValue(':description', $this->description);
        $statement->bindValue(':eventDate', $this->eventDate);
        $statement->bindValue(':roughlocation', $this->roughlocation);
        $statement->bindValue(':exactlocation', $this->exactlocation);
        $statement->bindValue(':dateCreated', $this->dateCreated);
        $statement->bindValue(':id_userCreator', $this->id_userCreator);

        return $statement->execute();
    }

}