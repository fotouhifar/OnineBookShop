<?php

namespace mvc\controller;

class Account extends Controller {
    public function __construct() {
        parent::__construct();
      
        if ($_SESSION['OBSusertype'] <> 'customer') {
            header("Location: ".PROJECT_URL);
        }


        $this->model = new \mvc\model\Account();
    }

    public function action() {
        $this->view = new \mvc\view\Account($this);
        $this->view->page();
    }

    public function getTitle() {
        return $_SESSION['OBSusertype'] . ' Account Page';
    }

}
