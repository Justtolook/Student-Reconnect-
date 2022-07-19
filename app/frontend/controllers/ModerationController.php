<?php
require_once 'Controller.php';
require_once 'app/frontend/models/ModerationModel.php';
require_once 'app/frontend/models/ReportModel.php';

class ModerationController extends Controller {

    public function moderation() {
        return $this->listAllReports();
    }

    public function listAllReports() {
        $model = new ModerationModel();
        $model->initReports($model->fetchAllReports());
        return $this->render('moderation', ['reports' => $model->reports]);
    }

    public function createEventReport() {
        $model = new ModerationModel();
        $model->createReport($request->getBody());
        return $this->listAllReports();
    }

    public function reportEvent(Request $request) {
        $model = new ModerationModel();
        $model->type = 'e';
        $model->id_objectReported = $request->getBody()['id_event'];
        return $this->render('reportformular', ['report' => $model]);
    }

    public function reportUser(Request $request) {
        $model = new ModerationModel();
        $model->type = 'u';
        $model->id_objectReported = $request->getBody()['id_user'];
        return $this->render('reportformular', ['report' => $model]);
    }

    public function handleReport(Request $request) {
        $model = new ReportModel();
        $model->type = $request->getBody()['type'];
        $model->id_objectReported = $request->getBody()['id_objectReported'];
        $model->id_userReporter = $this->getIDUser();
        $model->status = '0';
        $model->description = $request->getBody()['description'];
        if($model->validate()){
            $model->save();
            return $this->render('reportsuccess');
        }
        return $this->render('reportformular', ['report' => $model]);
    }

    public function dismissReport(Request $request) {
        $model = new ModerationModel();
        $model->dismissReport($request->getBody()['id_report']);
    }

    public function acceptReport(Request $request) {
        $model = new ModerationModel();
        $model->acceptReport($request->getBody()['id_report']);
    }



}