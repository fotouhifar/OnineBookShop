<?php

namespace mvc\controller;

class Categories extends Controller {

    public function __construct() {
        parent::__construct();
        $this->model = new \mvc\model\Categories();
    }

    /**
     *  The action displays the Categories page
     */
    public function action() {

        $this->view = new \mvc\view\Categories($this);
        $this->view->page();
    }

    /**
     *  The title of
     * 
     * @return string
     */
    public function getTitle() {
        return "Product categories";
    }

}

?>
