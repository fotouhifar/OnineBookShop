<?php

namespace mvc\controller;

class Report extends Controller {

    private $dataEntered = false;

    public function __construct() {
        parent::__construct();

        if ($_SESSION['OBSusertype'] <> 'admin') {
            header("Location: " . PROJECT_URL);
        }



        $reportQuery = filter_input(INPUT_POST, 'reportQuery');

        $this->dataEntered = (isset($reportQuery));


        if ($this->dataEntered) {
            $this->model = new \mvc\model\Report($reportQuery);
        }
    }

    /**
     *  The action displays the Products page
     */
    public function action() {

        $this->view = new \mvc\view\Report($this);
        $this->view->page();
    }

    /**
     * The title for the webpage comes from the model. 
     * The model gets the name of the category from the database as uses it as the title for the page. 
     * 
     * @return type
     */
    public function getTitle() {
        return "Reporting Page";
    }

}

?>
