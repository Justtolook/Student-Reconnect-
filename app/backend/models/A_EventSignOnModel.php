<?php
require_once 'Model.php';

class A_EventSignOnModel extends Model {
    public int $id_Event;
    public int $id_User;
    public string $signOnDate = "";
    public int $ratingHost;
    public int $ratingAttendee;
    public int $accepted;

    public function rules(): array {
        return [];
    }

    public function getSignOnsByEventId($id_event): array {
        $db = new Database();
        $statement = $db->prepare('SELECT * FROM eventSignOn WHERE id_event = :id_event');
        $statement->bindValue(':id_event', $id_event);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function setSignOnsByEventId($id_event) : void {
        $this->loadData($this->getSignOnsByEventId($id_event));
    }



    //TODO Save() and Delete()

}