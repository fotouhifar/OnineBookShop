<?php

namespace mvc\controller;

class Newsletter extends Controller {

    public $dataEntered = false;

    public function __construct($url) {
        parent::__construct();
        // 
        if ($_SESSION['OBSusertype'] <> 'admin') {
            header("Location: " . PROJECT_URL);
        }


        $nlSubject = filter_input(INPUT_POST, 'nlSubject');
        $nlMessage = filter_input(INPUT_POST, 'nlMessage');

        $this->dataEntered = ($nlMessage && $nlSubject);

        if ($this->dataEntered) {
            $this->model = new \mvc\model\Newsletter($nlSubject, $nlMessage);
        }
    }

    public function action() {
        $this->view = new \mvc\view\Newsletter($this);
        $this->view->page();
    }

    /**
     * The title for the webpage comes from the model. 
     * The model gets the name of the category from the database as uses it as the title for the page. 
     * 
     * @return type
     */
    public function getTitle() {
        return "Send Newsletter";
    }

    public function isDataValid() {
        return $this->dataEntered;
    }

}

?>
