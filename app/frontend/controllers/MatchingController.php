<?php
require_once 'Controller.php';

class MatchingController extends Controller {
    public function __construct() {
    }

    public function matching() {
        return $this->render('matching');
    }

}