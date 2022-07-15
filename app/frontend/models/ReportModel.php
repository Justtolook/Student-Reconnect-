<?php
require_once 'Model.php';

class ReportModel extends Model {
    public int $id_report;
    public string $description;
    public string $status = '0'; //0 = pending, 1 = accepted, 2 = rejected
    public string $type = '0'; //0 = not set, e = event, u = user
    public int $id_userReporter = 0;
    public int $id_objectReported = 0;
    public int $id_userModerator = 0;

    public function rules() : array {
        return [
            'description' => [self::RULE_REQUIRED],
            'type' => [self::RULE_REQUIRED],
            'id_userReporter' => [self::RULE_REQUIRED],
            'id_objectReported' => [self::RULE_REQUIRED]
        ];
    }

    public function save() : bool {
        $db = new Database();
        $statement = $db->prepare('INSERT INTO report (description, status, type, id_userReporter, id_objectReported, id_userModerator) VALUES (:description, :status, :type, :id_userReporter, :id_objectReported, :id_userModerator)');
        $statement->bindValue(':description', $this->description);
        $statement->bindValue(':status', $this->status);
        $statement->bindValue(':type', $this->type);
        $statement->bindValue(':id_userReporter', $this->id_userReporter);
        $statement->bindValue(':id_objectReported', $this->id_objectReported);
        $statement->bindValue(':id_userModerator', $this->id_userModerator);
        return $statement->execute();
    }

}