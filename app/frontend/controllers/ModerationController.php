<?php
require_once 'Controller.php';
require_once 'app/frontend/models/ModerationModel.php';

class ModerationController extends Controller {

    public function moderation() {
        return $this->listAllReports();
    }

    public function listAllReports() {
        $model = new ModerationModel();
        $model->initReports($model->fetchAllReports());
        return $this->render('moderation', ['reports' => $model->reports]);
    }



}