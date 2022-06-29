<?php
require_once 'Controller.php';
require_once 'app/backend/models/A_InterestModel.php';

class A_InterestsController extends Controller {
    public A_InterestModel $interestModel;

    public function __construct() {
        //set systemtype to backend of the application
        Application::$systemType = "backend";
        $this->interestModel = new A_InterestModel();
        $this->interestModel->fetchAllInterests();
    }

    public function home() {
        return $this->render('InterestsAdministration', ['interestModel' => $this->interestModel]);
    }

    /**
     * @param Request $request
     * @return void
     * API to get the data for specific interest by id from the database and return it as a JSON object
     */
    public function API_getInterest(Request $request) {
        $id_interest = $request->getBody()['iid'];
        $interest = $this->interestModel->getInterestById($id_interest);
        echo json_encode($interest);
    }

    /**
     * @param Request $request
     * @return void
     * API to update an interest
     */
    public function API_editInterest(Request $request) {
        $id_interest = $request->getBody()['id_interest'];
        $this->interestModel->interests[$id_interest] = $request->getBody()['name'];
        $this->interestModel->save($id_interest);
        Application::$app->response->redirect("?t=backend&request=interests");
    }

    /**
     * @param Request $request
     * @return void
     * API to add an interest
     */
    public function API_addInterest(Request $request) {
        $this->interestModel->add($request->getBody()['interest-add-name']);
        Application::$app->response->redirect("?t=backend&request=interests");
    }
}