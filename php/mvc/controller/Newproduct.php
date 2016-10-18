<?php

namespace mvc\controller;

class Newproduct extends Controller {

    private $dataEntered = false;

    public function __construct($url) {
        parent::__construct();

                if ($_SESSION['OBSusertype'] <> 'admin') {
            header("Location: " . PROJECT_URL);
        }

              $PId=  filter_input(INPUT_POST, 'PId');
        $PTitle = filter_input(INPUT_POST, 'PTitle');
        $PAuthor = filter_input(INPUT_POST, 'PAuthor');
        $PDescription = filter_input(INPUT_POST, 'PDescription');
        $PDate = filter_input(INPUT_POST, 'PDate');
        $PImage = filter_input(INPUT_POST, 'PImage');
        $PCategory = filter_input(INPUT_POST, 'PCategory');
        $PInstock = filter_input(INPUT_POST, 'PInstock');
        $PPrice = filter_input(INPUT_POST, 'PPrice');
        $PSold = filter_input(INPUT_POST, 'PSold');

        $this->dataEntered = ($PTitle && $PCategory && $PInstock && $PPrice && $PSold);
        
        if ($this->dataEntered) {
            $this->model = new \mvc\model\Newproduct($PId,$PTitle,$PAuthor,$PDescription,$PDate,$PImage,$PCategory,$PInstock,$PPrice,$PSold);
        }
    }

    /**
     *  The action displays the Products page
     */
    public function action() {

        $this->view = new \mvc\view\Newproduct($this);
        $this->view->page();
    }

    /**
     * The title for the webpage comes from the model. 
     * The model gets the name of the category from the database as uses it as the title for the page. 
     * 
     * @return type
     */
    public function getTitle() {
        return "New Product";
    }

    public function isDataValid() {
        return $this->dataEntered;
    }

}

?>
