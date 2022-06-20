<?php
include 'config.php';
include 'Model.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (validate() == FALSE) {
        exit;                               // TO DO complete error handling
    }
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birthdate = $_POST['birthdate'];

    $pdo = new PDO ('Config');              // TO DO complete statement

    $statement1 = $pdo->prepare("SELECT * FROM Users WHERE email = $email");
    while ($row = $statement1->fetch()) {
        if (!empty($row['email'])) {
            exit;                           // TO DO complete error handling
        }
    }

    $data = new array($firstname, $lastname, $email, $password, $birthdate);
    $statement2 = $pdo->prepare("INSERT INTO Users (firstname, lastname, email, password, birthdate) VALUES (?, ?, ?, ?, ?)");
    $statement2->execute($data);
}
?>
// register backend

// TO DO include into frontend and complete  frontend functionality