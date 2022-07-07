<?php
require_once 'Controller.php';
require_once 'app/frontend/models/VisitenkartenModel.php';

class VisitenkartenController extends Controller {
    public VisitenkartenModel $visitenkartenModel; 
    public function __construct() {
        
    }
    

    public function API_getVisitenkarte(Request $request) {
        $id_user = $request->getBody()['id_user'];
        $this->visitenkartenModel = new VisitenkartenModel($id_user);
        echo json_encode($this->visitenkartenModel);
    }
}


?>