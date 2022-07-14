<?php
require_once 'Model.php';
require_once 'Database.php';

class EditProfilePicModel extends Model {
    public Database $db;
    public int $id_user;

    public function __construct() {
        $this->db = new Database();
        $this->id_user = $_SESSION['user']['id_user'];
    }

    public function rules(): array {
        return [];
    }

    public function uploadProfileImg() {
        $target_dir = "res/imgprofile/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is an actual image or fake image
        if(isset($_POST["submit"])) {
            if(empty($_FILES["fileToUpload"]["tmp_name"])) {
                return false;
            }
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "Ihre Datei ist kein Bild.";
                $uploadOk = 0;
            }
        }
  
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Es tut uns leid, Ihre Datei ist zu groß.";
            $uploadOk = 0;
        }
  
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "Es sind nur jpg, jpeg oder png Dateien erlaubt.";
            $uploadOk = 0;
        }

  
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Beim Hochladen Ihrer Datei ist ein Fehler aufgetreten.";
            return false;
        // if everything is ok, try to upload file
        } else {
            $filename = $this->renameFile($target_dir, $imageFileType);
            $filename = $filename . "." . $imageFileType;
            $target_file = $target_dir . $filename;
    
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "Die Datei ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " wurde hochgeladen.";
                return $filename;
            } else {
                echo "Beim Hochladen Ihrer Datei ist ein Fehler aufgetreten.";
                return false;
            }
        }
        
    }

    public function renameFile($target_dir, $imageFileType) {
        $filename = rand(10000000,99999999);
        $target_file = $target_dir . $filename . "." . $imageFileType;

        if (file_exists($target_file)) {
            $filename = renameFile($target_dir, $imageFileType);
        }
        return $filename;
    }

    public function saveNewImageRef() {
        $imageref = $this->uploadProfileImg();
        if($imageref == false) {
            return false;
        }
        $statement1 = $this->db->prepare('SELECT image FROM user WHERE id_user = :id_user');
        $statement1->bindValue(':id_user', $this->id_user);
        $statement1->execute();
        $row = $statement1->fetch();
        if(!empty($row['image'])) {
            $oldimageref = $row['image'];
            if($oldimageref !== "placeholder.jpg") {
                $targetdir = "res/imgprofile/" . $oldimageref;
                echo (unlink($targetdir));
            }
        }
        $statement2 = $this->db->prepare('UPDATE user SET image = :imageref WHERE id_user = :id_user');
        $statement2->bindValue(':imageref', $imageref);
        $statement2->bindValue(':id_user', $this->id_user);
        
        return $statement2->execute();
    }

    public function getProfileImagePath() {
        $statement1 = $this->db->prepare('SELECT image FROM user WHERE id_user = :id_user');
        $statement1->bindValue(':id_user', $this->id_user);
        $statement1->execute();
        $row = $statement1->fetch();
        $placeholder = "placeholder.jpg";
        if(!empty($row['image'])) {
            $imageRef = $row['image'];
            $imagePath = "res/imgprofile/" . $imageRef;
            return $imagePath;
        }else{
            $statement2 = $this->db->prepare('UPDATE user SET image = :image WHERE id_user = :id_user');
            $statement2->bindValue(':id_user', $this->id_user);
            $statement2->bindValue(':image', $placeholder);
            $statement2->execute();
            $placeholderPath = "res/imgprofile/" . $placeholder;
            return $placeholderPath;
        }
    }

    public function removeProfileImage() {
        $statement = $this->db->prepare('UPDATE user SET image = :image WHERE id_user = :id_user');
        $placeholder = "placeholder.jpg";
        $statement->bindValue(':id_user', $this->id_user);
        $statement->bindValue(':image', $placeholder);
        $statement->execute();
    }
}
?>