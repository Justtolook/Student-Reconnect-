<?php
require_once 'Model.php';
require_once 'Database.php';
require_once 'ReportModel.php';

class ModerationModel extends Model {
    public array $reports;
    public Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function rules() : array {
        return [];
    }

    public function initReports($reportsQuery) {
        foreach ($reportsQuery as $report) {
            $temp = new ReportModel();
            $temp->loadData($report);
            $this->reports[] = $temp;
        }
    }

    public function fetchAllReports() : array {
        $statement = $this->db->prepare("SELECT * FROM report");
        $statement->execute();
        return $statement->fetchAll();
    }
}