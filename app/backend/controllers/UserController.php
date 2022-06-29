<?php
require_once 'Controller.php';
require_once 'app/backend/models/A_UserAdministrationModel.php';
require_once 'app/backend/models/A_InterestModel.php';

class UserController extends Controller {
    public A_UserAdministrationModel $userAdministrationModel;
    public A_InterestModel $interestModel;

    public function __construct() {
        /**
         * check if user is logged in. If they are not, user will be redirected to the login page
         */
        //if(!$this->isLoggedIn()) Application::$app->response->redirect("?t=frontend&request=login");

        //set systemtype to backend of the application
        Application::$systemType = "backend";
        $this->interestModel = new A_InterestModel();
        $this->userAdministrationModel = new A_UserAdministrationModel();
        $this->interestModel->fetchAllInterests();
    }
    public function home() {

        return $this->render('UserAdministration', ['users' => $this->userAdministrationModel->users, 'interestModel' => $this->interestModel]);
    }

    /**
     * @param Request $request
     * @return void
     * API to get the data a specific user by id from the database and return it as a JSON object
     */
    public function API_getUserById(Request $request) {
        $id_user = $request->getBody()['uid'];
        $user = $this->userAdministrationModel->getUserById($id_user);
        echo json_encode($user);
    }

    /**
     * @param Request $request
     * @return void
     * API to update a user
     */
    public function API_editUser(Request $request) {
        $id_user = $request->getBody()['id_user'];
        $user = $this->userAdministrationModel->getUserById($id_user);
        $user->loadData($request->getBody());
        $this->userAdministrationModel->hasInterestModel->setInterestsForUserID($user->id_user, $request->getBody()['interests']);
        $user->save();
        Application::$app->response->redirect("?t=backend&request=user");
    }

    /**
     * @param Request $request
     * delete user by id
     */
    public function API_deleteUser(Request $request) {
        $id_user = $request->getBody()['id_user'];
        $user = $this->userAdministrationModel->getUserById($id_user);
        $user->delete();
        Application::$app->response->redirect("?t=backend&request=user");
    }


}