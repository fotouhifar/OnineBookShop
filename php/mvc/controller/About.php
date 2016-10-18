<?php

namespace mvc\controller;

/**
 * Categories controller generates a webpage that displays all the product categories
 * This is the default home page for the site.
 * bootstrap.php defaults to this page if it receives a URL which specifies a nonexistant Controller class.  
 */
class About extends Controller {

    /**
     *  The constructor load instantiates a the Categories Model. 
     */
    public function __construct() {
        parent::__construct();

    }

    /**
     *  The action displays the Categories page
     */
    public function action() {

        $this->view = new \mvc\view\About($this);
        $this->view->page();
    }

    /**
     *  The title of
     * 
     * @return string
     */
    public function getTitle() {
        return "About Online Book Shop Project";
    }

}

?>
