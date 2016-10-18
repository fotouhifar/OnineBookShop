<?php

namespace mvc\controller;

class Cart extends Controller {

    public function __construct($data) {
        parent::__construct();
      
      //  $categoryURL = (isset($data[1])) ? $data[1] : "";
        $productID = (isset($data[2])) ? $data[2] : "";
        $quantity = (isset($data[3])) ? $data[3] : 1;

        $this->model = new \mvc\model\Cart($this->cart,$productID, $quantity);

        $_SESSION['OBScart'] = $this->model->getCart();
    }

    public function action() {
        $this->view = new \mvc\view\Cart($this);
        $this->view->page();
    }

    public function getTitle() {
        return "Shopping Cart Details";
    }

    public function isCheckout() {
        return (count($this->model->getCart()) > 0) && !$this->model->cartExceedsStock() && $this->isSignedIn();
    }

}

?>
