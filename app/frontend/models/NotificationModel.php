<?php
require_once 'Model.php';
require_once 'app/frontend/models/MatchModel.php';

class NotificationModel extends Model {
    public Database $db;
    public int $id_myself;
    public int $id_User_1;
    public int $id_User_2;
    public int $timestamp;
    public $name;
    public $description;
    public $location_rough;
    public $eventDate;
    public int $notificationRead;
    public array $matches = [];
    //public MatchModel $matchModel;

    public function __construct(int $id_myself){
        $this->db = new Database();
        $this->id_myself = $id_myself;
        $this->fetchMatches();
        $this->getAcceptedEvents($this->id_myself);
        //$this->matchModel = new MatchModel($id_myself);
    }

    public function rules() : array {
        return [];
    }
       
    public function fetchMatches() {
        $statement = $this->db->prepare('SELECT * FROM matches WHERE id_User_1 = :id_myself OR id_User_2 = :id_myself');
        $statement->bindValue(':id_myself', $this->id_myself);
        $statement->execute();
        $matches = [];
        foreach($statement->fetchAll() as $item) {
            if ($item['id_User_1'] == $this->id_myself) {
                $this->matches[] = array (
                    'id_user' => $item['id_User_2'], 
                    'timestamp' => $item['timestamp'], 
                    'notificationRead' => $item['notificationRead']); 
              
            } else {
                $this->matches[] = array (
                    'id_user' => $item['id_User_1'], 
                    'timestamp' => $item['timestamp'], 
                    'notificationRead' => $item['notificationRead']); 
               

            }
        }
    }

    public function setNotificationToRead($id_user_match){
            $statement = $this->db->prepare('UPDATE matches SET notificationRead = 1
                 WHERE (id_User_1 = :id_myself AND id_User_2 = :id_user_match)  
                 OR (id_User_2 = :id_myself AND id_User_1 = :id_user_match)');
            $statement->bindValue(':id_myself', $this->id_myself);
            $statement->bindValue(':id_user_match', $id_user_match);
            $statement->execute();
    }



    public function getAcceptedEvents($id_user){
        $db = new Database();
        $statement = $db->prepare('SELECT * FROM eventSignOn INNER Join event on eventSignOn.id_Event = event.id_event');
        $statement->execute();
        $eventsSignedIn = [];
        foreach($statement->fetchAll() as $item) {
            if ($item['id_User'] == $id_user && $item['accepted'] == 1) {
                $this->eventsSignedIn[] = array (
                    'event_id_user' => $item['id_User'],
                    'event_id' => $item['id_Event'], 
                    'event_name' => $item['name'],
                    'event_location_rough' => $item['location_rough'],
                    'event_time' => $item['eventDate'], 
                    'event_id_userCreator' => $item['id_userCreator']);
                }
        }   
    }


}


?>