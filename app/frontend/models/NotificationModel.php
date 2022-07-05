<?php
require_once 'Model.php';
require_once 'app/frontend/models/MatchModel.php';

class NotificationModel extends Model {
    public Database $db;
    public int $id_myself;
    public int $id_User_1;
    public int $id_User_2;
    public int $timestamp;
    public int $notificationRead;
    public array $matches = [];
    //public MatchModel $matchModel;

    public function __construct(int $id_myself){
        $this->db = new Database();
        $this->id_myself = $id_myself;
        $this->fetchMatches();
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
    

}


?>