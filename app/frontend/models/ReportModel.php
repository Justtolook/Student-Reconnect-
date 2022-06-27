<?php
require_once 'Model.php';

class ReportModel extends Model {
    public int $id_report;
    public string $description;
    public string $status;
    public int $id_userReporter;
    public int $id_userReported;
    public int $id_userModerator;

    public function rules() : array {
        return [];
    }
}