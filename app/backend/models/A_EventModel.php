<?php
require_once 'Model.php';
require_once 'Database.php';

class A_EventModel extends Model {
    public int $id_event;
    public string $name = "";
    public string $description = "";
    public string $location = "";
    public string $location_rough = "";
    public int $id_userCreator;
    public $eventDate;
    public $createdTimestamp;
    public int $numberAttendees = 0;


    public function rules(): array {
        return [];
    }

    public function save() : bool {
        $db = new Database();
        $statement = $db->prepare('UPDATE event SET name = :name, description = :description, location = :location, location_rough = :location_rough, eventDate = :eventDate, id_userCreator = :id_userCreator, createdTimestamp = :createdTimestamp, numberAttendees = :numberAttendees WHERE id_event = :id_event');
        $statement->bindValue(':id_event', $this->id_event);
        $statement->bindValue(':name', $this->name);
        $statement->bindValue(':description', $this->description);
        $statement->bindValue(':location', $this->location);
        $statement->bindValue(':id_userCreator', $this->id_userCreator);
        $statement->bindValue(':location_rough', $this->location_rough);
        $statement->bindValue(':eventDate', $this->eventDate);
        $statement->bindValue(':createdTimestamp', $this->createdTimestamp);
        $statement->bindValue(':numberAttendees', $this->numberAttendees);
        return $statement->execute();
    }

    public function delete() : bool {
        $db = new Database();
        $statement = $db->prepare('DELETE FROM event WHERE id_event = :id_event');
        $statement->bindValue(':id_event', $this->id_event);
        return $statement->execute();
    }

}