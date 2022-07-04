<?php
require_once 'Model.php';
require_once 'Database.php';

class EditProfilePicModel extends Model {
    public Database $db;
    public int $id_user;
    public string $imageref;

    public function __construct() {
        $this->db = new Database();
        $this->id_user = $_SESSION['user']['id_user'];
    }

    public function rules(): array {
        return [];
    }

    public function saveImageRef() {
        $statement = $this->db->prepare('UPDATE user SET image = :imageref WHERE id_user = :id_user');
        $statement->bindValue(':imageref', $this->imageref);
        $statement->bindValue(':id_user', $this->id_user);
        
        return $statement->execute();
    }
}
?>