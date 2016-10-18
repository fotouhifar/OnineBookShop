<?php

namespace mvc\controller;

class Dashboard extends Controller {

    public function __construct() {
        parent::__construct();

        if ($_SESSION['OBSusertype'] <> 'admin') {
            header("Location: " . PROJECT_URL);
        }

        $this->model = new \mvc\model\Dashboard();
    }

    public function action() {
        $this->view = new \mvc\view\Dashboard($this);
        $this->view->page();
    }

    public function getTitle() {
        return $_SESSION['OBSusertype'] . ' Dashboard Page';
    }

}
