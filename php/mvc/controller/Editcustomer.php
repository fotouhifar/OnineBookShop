<?php

namespace mvc\controller;

class Editcustomer extends Controller {

    private $dataEntered = false;
    private $isSignedIn = false;

    public function __construct($url) {
        parent::__construct();


        $editquery = filter_input(INPUT_POST, 'editquery');
        $id = filter_input(INPUT_POST, 'id');
        $fn = filter_input(INPUT_POST, 'fn');
        $ln = filter_input(INPUT_POST, 'ln');
        $ad = filter_input(INPUT_POST, 'ad');
        $sb = filter_input(INPUT_POST, 'sb');
        $st = filter_input(INPUT_POST, 'st');
        $pc = filter_input(INPUT_POST, 'pc');
        $cr = filter_input(INPUT_POST, 'cr');
        $type= filter_input(INPUT_POST, 'type');

        $this->dataEntered = ($editquery && $fn && $ln && $type);
        if ($this->dataEntered) {
            $this->model = new \mvc\model\Editcustomer($editquery, $id, $fn, $ln, $ad, $sb, $st, $pc, $cr, $type);
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
