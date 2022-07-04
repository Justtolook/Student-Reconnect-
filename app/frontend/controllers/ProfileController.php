<?php
require_once 'Controller.php';
require_once 'app/frontend/models/VisitenkartenModel.php';
require_once 'app/frontend/models/InterestModel.php';
require_once 'app/frontend/models/ShowProfileModel.php';
require_once 'app/frontend/models/EditProfileModel.php';

require_once 'Database.php';

class ProfileController extends Controller {
    public VisitenkartenModel $visitenkartenModel;
    public InterestModel $interestModel;
    public ShowProfileModel $ShowProfileModel;
    public int $id_user;

    public function __construct() {
        $this->id_user = $_SESSION['user']['id_user'];
        $this->visitenkartenModel = new VisitenkartenModel($this->id_user);
        $this->ShowProfileModel = new ShowProfileModel($this->id_user);
        $this->interestModel = new InterestModel();
    }
    /**
     * @return string
     * render the standard profile page
     */
    public function profile() {
        $this->interestModel->fetchAllInterests();
        return $this->render("profile", ["visitenkarte" => $this->visitenkartenModel, "interestModel" => $this->interestModel, "profile" => $this->ShowProfileModel]);
    }

    public function profileedit() {
        $EditProfileModel = new EditProfileModel();
        return $this->render('profileedit', ['model' => $EditProfileModel]);
    }
}