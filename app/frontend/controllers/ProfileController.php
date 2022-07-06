<?php
require_once 'Controller.php';
require_once 'app/frontend/models/VisitenkartenModel.php';
require_once 'app/frontend/models/InterestModel.php';
require_once 'app/frontend/models/HasInterestModel.php';
require_once 'app/frontend/models/ShowProfileModel.php';
require_once 'app/frontend/models/EditProfileModel.php';
require_once 'app/frontend/models/EditProfilePicModel.php';

require_once 'Database.php';

class ProfileController extends Controller {
    public VisitenkartenModel $visitenkartenModel;
    public InterestModel $interestModel;
    public HasInterestModel $hasInterestModel;
    public ShowProfileModel $ShowProfileModel;
    public EditProfileModel $EditProfileModel;
    public EditProfilePicModel $EditProfilePicModel;
    public int $id_user;

    public function __construct() {
        $this->id_user = $_SESSION['user']['id_user'];
        $this->visitenkartenModel = new VisitenkartenModel($this->id_user);
        $this->ShowProfileModel = new ShowProfileModel($this->id_user);
        $this->interestModel = new InterestModel();
        $this->hasInterestModel = new HasInterestModel();
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
        return $this->render("profileedit", ["model" => $EditProfileModel, "profile" => $this->ShowProfileModel, "interestModel" => $this->interestModel, "hasInterestModel" => $this->hasInterestModel]);
    }

    public function handleProfileEditing(Request $request) {
        $EditProfileModel = new EditProfileModel();
        $EditProfileModel->loadData($request->getBody());
        if($EditProfileModel->validate() && $EditProfileModel->saveChanges()) {
            Application::$app->response->redirect("?t=frontend&request=profile");
            return;
        }
        return $this->render('profileedit', ['model' => $EditProfileModel, "profile" => $this->ShowProfileModel]);
    }

    public function profilepicedit() {
        $EditProfilePicModel = new EditProfilePicModel();
        return $this->render('profilepicedit', ['model' => $EditProfilePicModel]);
    }    

    public function handleProfilePicEditing(Request $request) {
        $EditProfilePicModel = new EditProfilePicModel();
        if($EditProfilePicModel->saveNewImageRef()) {
            Application::$app->response->redirect("?t=frontend&request=profile");
            return;
        }

        return $this->render('profilepicedit', ['model' => $EditProfilePicModel]);
    }
}
?>