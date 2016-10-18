<?php

namespace mvc\controller;

class Register extends Controller {

    private $dataEntered = false;

    public function __construct($url) {
        parent::__construct();

        $fn = filter_input(INPUT_POST, 'fn');
        $ln = filter_input(INPUT_POST, 'ln');
        $em = filter_input(INPUT_POST, 'em');
        $pw = filter_input(INPUT_POST, 'pw');
        $nl = filter_input(INPUT_POST, 'nl');
        $ad = filter_input(INPUT_POST, 'ad');
        $sb = filter_input(INPUT_POST, 'sb');
        $st = filter_input(INPUT_POST, 'st');
        $pc = filter_input(INPUT_POST, 'pc');
        $cr = filter_input(INPUT_POST, 'cr');

        // checkbox data needs to be validated
        $nl = ($nl == null) ? '0' : '1';

        $this->dataEntered = ($fn && $ln && $em && $pw );

        if ($this->dataEntered) {
            $this->model = new \mvc\model\Register($fn, $ln, $em, $pw, $nl, $ad, $sb, $st, $pc, $cr);
        }
    }

    /**
     *  The action displays the Products page
     */
    public function action() {

        $this->view = new \mvc\view\Register($this);
        $this->view->page();
    }

    /**
     * The title for the webpage comes from the model. 
     * The model gets the name of the category from the database as uses it as the title for the page. 
     * 
     * @return type
     */
    public function getTitle() {
        return "Registration Form";
    }

    public function isDataValid() {
        return $this->dataEntered;
    }

}

?>
