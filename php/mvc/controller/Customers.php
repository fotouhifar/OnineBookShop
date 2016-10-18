<?php
namespace mvc\controller;


class Customers extends Controller{
   
    public function __construct() {
        parent::__construct();
        // 
        
        if ($_SESSION['OBSusertype'] <> 'admin') {
            header("Location: " . PROJECT_URL);
        }

            $this->model = new \mvc\model\Customers();
     
    }

    public function action() {
        $this->view = new \mvc\view\Customers($this);
        $this->view->page();
    }

    public function getTitle() {
        return "Customer List";
    }
}

?>
