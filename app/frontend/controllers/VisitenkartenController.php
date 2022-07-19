<?php
require_once 'Controller.php';
require_once 'app/frontend/models/VisitenkartenModel.php';
require_once 'app/frontend/models/EditProfilePicModel.php';
require_once 'app/frontend/models/InterestModel.php';
require_once 'app/frontend/models/HasInterestModel.php';

class VisitenkartenController extends Controller {
    public VisitenkartenModel $visitenkartenModel; 
    public function __construct() {
        
    }
    

    public function API_getVisitenkarte(Request $request) {
        $id_user = $request->getBody()['id_user'];
        $this->visitenkartenModel = new VisitenkartenModel($id_user);
        echo json_encode($this->visitenkartenModel);
    }

    public function API_getVisitenkartenContent(Request $request) {
        $id_user = $request->getBody()['uid'];
        $this->visitenkartenModel = new VisitenkartenModel($id_user);
        $interestModel = new InterestModel();
        $interestModel->fetchAllInterests();

        $hasInterestModel = new HasInterestModel();
        $profilepicmodel = new EditProfilePicModel($id_user);
        echo $this->renderContent("visitenkartenModal", ["visitenkarte" => $this->visitenkartenModel, "profilepicmodel" => $profilepicmodel, "interestModel" => $interestModel, "hasInterestModel" => $hasInterestModel]);
    }
}


?>