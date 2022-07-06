<?php
require_once 'Model.php';
require_once 'Database.php';

class EditProfilePicModel extends Model {
    public Database $db;
    public int $id_user;
    public string $oldimageref;

    public function __construct() {
        $this->db = new Database();
        $this->id_user = $_SESSION['user']['id_user'];
    }

    public function rules(): array {
        return [];
    }

    public function uploadProfileImg() {
        $target_dir = "web06.iis.uni-bamberg.de/WIP/wip22_g1/imgprofile/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is an actual image or fake image
        if(isset($_POST["submit"])) {
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
            return;
        // if everything is ok, try to upload file
        } else {
            $filename = $this->renameFile($target_dir, $imageFileType);
            $target_file = $target_dir . $filename . "." . $imageFileType;
    
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "Die Datei ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " wurde hochgeladen.";
                return $filename;
            } else {
                echo "Beim Hochladen Ihrer Datei ist ein Fehler aufgetreten.";
                return;
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
        if(empty($imageref)) {
            return;
        }
        $statement1 = $this->db->prepare('SELECT image FROM user WHERE id_user = :id_user');
        $statement1->bindValue(':id_user', $this->id_user);
        $statement1->execute();
        $this->oldimageref = $statement1->fetch();
        $targetdir = "imgprofile/" . "$this->oldimageref";
        unlink("$targetdir");
        $statement2 = $this->db->prepare('UPDATE user SET image = :imageref WHERE id_user = :id_user');
        $statement2->bindValue(':imageref', $imageref);
        $statement2->bindValue(':id_user', $this->id_user);
        
        return $statement2->execute();
    }
}
?>