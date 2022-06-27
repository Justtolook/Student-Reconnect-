<?php
require_once 'Controller.php';
require_once 'app/frontend/models/VisitenkartenModel.php';
require_once 'Database.php';
class ProfileController extends Controller {

    /**
     * @return string
     * render the standard profile page
     */
    public function home() {
        $visitenkartenModel = new VisitenkartenModel();

        $temp = $visitenkartenModel->getVisitenkartenByUserID($_SESSION['user']['id_user']);
        $visitenkartenModel->loadData($temp);
        echo "<pre>";
        print_r($visitenkartenModel);
        return $this->render("profile");
    }

}