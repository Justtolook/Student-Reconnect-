<?php
require_once 'Controller.php';
class ProfileController extends Controller {

    /**
     * @return string
     * render the standard profile page
     */
    public function profile() {
        return $this->render("profile");
    }

}