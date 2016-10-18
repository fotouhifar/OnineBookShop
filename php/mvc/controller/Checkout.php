<?php

namespace mvc\controller;

class Checkout extends Controller {

    public function __construct() {
        parent::__construct();


        if ($_SESSION['OBSusertype'] <> 'customer') {
            header("Location: " . PROJECT_URL);
        }
        
        

        $this->model = new \mvc\model\Checkout($this->cart);
    }

    public function action() {
          $this->view = new \mvc\view\Checkout($this);
          $this->view->page();
    }

    public function getTitle() {
                return "Checkout";

    }

}

?>
