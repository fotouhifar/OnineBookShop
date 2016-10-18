<?php

namespace mvc\controller;

class Search extends Controller {

    public function __construct() {
        parent::__construct();
        // 
        extract($_POST);
        if (!isset($search))
            $search = '';
        if (!isset($SortBy))
            $SortBy = 0;
        if (!isset($PriceRange))
            $PriceRange = 0;

        $this->model = new \mvc\model\Search($search, $SortBy, $PriceRange);
    }

    public function action() {
        $this->view = new \mvc\view\Search($this);
        $this->view->page();
    }

    public function getTitle() {
        return "";
    }

}

?>
