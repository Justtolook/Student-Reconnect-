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

    public function dismissReport($id_report) {
        $statement = $this->db->prepare("UPDATE report SET status = '2' WHERE id_report = :id_report");
        echo "dismiss";
        $statement->bindParam(':id_report', $id_report);
        $statement->execute();
    }

    public function getReport($id_report) {
        foreach ($this->reports as $report) {
            if($report->id_report == $id_report) {
                return $report;
            }
        }
    }

    public function acceptReport($id_report) {
        $this->initReports($this->fetchAllReports());
        $report = $this->getReport($id_report);
        $report->dismiss();

        if($report->type == 'e') {
            $event = new EventModel();
            $event->id_event = $report->id_objectReported;
            $event->delete();
        } else if($report->type == 'u') {
            $user = new UserModel();
            $user->id_user = $report->id_objectReported;
            $user->delete();
        }
        $statement = $this->db->prepare("UPDATE report SET status = '1' WHERE id_report = :id_report");
        $statement->bindParam(':id_report', $id_report);
        $statement->execute();
    }
}