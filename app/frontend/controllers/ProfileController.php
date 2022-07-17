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
    public array $interestArray = [];

    public function __construct() {
        $this->id_user = $_SESSION['user']['id_user'];
        $this->visitenkartenModel = new VisitenkartenModel($this->id_user);
        $this->ShowProfileModel = new ShowProfileModel($this->id_user);
        $this->interestModel = new InterestModel();
        $this->interestModel->fetchAllInterests();
        $this->hasInterestModel = new HasInterestModel();
        $this->hasInterestModel->fetchInterestsForUserID($this->id_user);
        $this->ShowProfileModel->interests = $this->hasInterestModel->getInterestsForUserID($this->id_user);
        $this->EditProfilePicModel = new EditProfilePicModel();
        $this->EditProfilePicModel->id_user = $this->id_user;
        $this->EditProfileModel = new EditProfileModel();
    }
    /**
     * @return string
     * render the standard profile page
     */
    public function profile() {
        $this->interestModel->fetchAllInterests();
        return $this->render("profile", ["visitenkarte" => $this->visitenkartenModel, "interestModel" => $this->interestModel, "profile" => $this->ShowProfileModel, "profilepicmodel" => $this->EditProfilePicModel]);
    }

    public function profileedit() {
        return $this->render("profileedit", ["model" => $this->EditProfileModel, "profile" => $this->ShowProfileModel, "interestModel" => $this->interestModel, "hasInterestModel" => $this->hasInterestModel]);
    }

    public function handleProfileEditing(Request $request) {
        $EditProfileModel = new EditProfileModel();
        $EditProfileModel->firstname = $request->getBody()['firstname'];
        $EditProfileModel->lastname = $request->getBody()['lastname'];
        $EditProfileModel->description = $request->getBody()['description'];
        $EditProfileModel->contactInformation = $request->getBody()['contactInformation'];
        $this->interestArray = [];
        if(!empty($_POST['interests'])) {
            foreach($_POST['interests'] as $interest) {
                array_push($this->interestArray, $this->interestModel->getInterestID($interest));
            }
        }
        $EditProfileModel->interests = $this->interestArray;
        if($EditProfileModel->validate() && $EditProfileModel->saveChanges()) {
            Application::$app->response->redirect("?t=frontend&request=profile");
            return;
        }
        return $this->render('profileedit', ['model' => $EditProfileModel, "profile" => $this->ShowProfileModel]);
    }

    public function profilepicedit() {
        $EditProfilePicModel = new EditProfilePicModel();
        return $this->render('profile', ['model' => $EditProfilePicModel]);
    }    

    public function handleProfilePicEditing(Request $request) {
        $EditProfilePicModel = new EditProfilePicModel();
        if($EditProfilePicModel->saveNewImageRef()) {
            Application::$app->response->redirect("?t=frontend&request=profile");
            return;
        }

        return $this->render('profile', ["visitenkarte" => $this->visitenkartenModel, "interestModel" => $this->interestModel, "profile" => $this->ShowProfileModel, "profilepicmodel" => $this->EditProfilePicModel]);
    }

    public function removeProfilePic(Request $request) {
        if($this->EditProfilePicModel->removeProfileImage()) {
            Application::$app->response->redirect("?t=frontend&request=profile");
            return;
        }

        return $this->render('profile', ["visitenkarte" => $this->visitenkartenModel, "interestModel" => $this->interestModel, "profile" => $this->ShowProfileModel, "profilepicmodel" => $this->EditProfilePicModel]);
    }
}
?>