<?php
require_once 'Model.php';
require_once 'Database.php';

class A_UserModel extends Model {
    public int $id_user;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $gender;
    public $birthdate;
    public $image;
    public string $description = "";
    public string $contactInformation = "";
    public int $scoreHost = 0;
    public int $scoreAttendee = 0;
    public int $id_role = 0;
    public array $interests;

    public function rules(): array {
        return [];
    }

    public function save() : bool {
        $db = new Database();
        $statement = $db->prepare('UPDATE user SET firstname = :firstname, lastname = :lastname, email = :email, gender = :gender, birthdate = :birthdate, description = :description, scoreHost = :scoreHost, scoreAttendee = :scoreAttendee, id_role = :id_role, contactInformation = :contactInformation WHERE id_user = :id_user');
        $statement->bindValue(':firstname', $this->firstname);
        $statement->bindValue(':lastname', $this->lastname);
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':gender', $this->gender);
        $statement->bindValue(':birthdate', $this->birthdate);
        $statement->bindValue(':description', $this->description);
        $statement->bindValue(':scoreHost', $this->scoreHost);
        $statement->bindValue(':scoreAttendee', $this->scoreAttendee);
        $statement->bindValue(':contactInformation', $this->contactInformation);
        $statement->bindValue('id_role', $this->id_role);
        $statement->bindValue('id_user', $this->id_user);
        return $statement->execute();
    }

    public function delete() : bool {
        $db = new Database();
        $statement = $db->prepare('DELETE FROM user WHERE id_user = :id_user');
        $statement->bindValue(':id_user', $this->id_user);
        return $statement->execute();
    }
}