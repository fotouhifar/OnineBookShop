<?php

namespace mvc\controller;

class Editproduct extends Controller {

    private $dataEntered = false;
    private $isSignedIn = false;

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
            $this->model = new \mvc\model\Editproduct($PId,$PTitle,$PAuthor,$PDescription,$PDate,$PImage,$PCategory,$PInstock,$PPrice,$PSold);
        }

        /*
        <?= PROJECT_URL . 'productspec' . '/' . $product->getSpecificationURL() ?>
        */
        
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
