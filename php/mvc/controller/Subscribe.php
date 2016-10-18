<?php

namespace mvc\controller;

class Subscribe extends Controller {

    private $dataEntered = false;
    private $isSignedIn = false;

    public function __construct($url) {
        parent::__construct();
        $em = filter_input(INPUT_POST, 'em');
        $this->dataEntered = ($em);
        if ($this->dataEntered) {
            $this->model = new \mvc\model\Subscribe($em);
            
        }
        
       $referer = $_SERVER['HTTP_REFERER'];
            
        header('Location:' . $referer);
    }

    public function action() {
                   
 //           $this->view = new \mvc\view\Subscribe($this);
    //    $this->view->page();
    }

    public function getTitle() {
        
    }


}

?>
