<?php
$target_dir = "imgprofile/";
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

// Check if file already exists
if (file_exists($target_file)) {
    unlink("$target_file");
    $uploadOk = 1;
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
    echo "Es tut uns leid, Ihre Datei konnte nicht hochgeladen werden.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "Die Datei ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " wurde hochgeladen.";
    } else {
      echo "Beim Hochladen Ihrer Datei ist ein Fehler aufgetreten.";
    }
  }
  ?>
?>