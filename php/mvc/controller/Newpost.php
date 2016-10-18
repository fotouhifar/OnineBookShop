<?php

namespace mvc\controller;

class Newpost extends Controller {

    private $dataEntered = false;

    public function __construct($url) {
        parent::__construct();
        
        if ($_SESSION['OBSusertype'] <> 'admin') {
            header("Location: " . PROJECT_URL);
        }


        $postTitle = filter_input(INPUT_POST, 'postTitle');
        $postContent = filter_input(INPUT_POST, 'postContent');

        $this->dataEntered = ($postTitle && $postContent );

        if ($this->dataEntered) {
            $this->model = new \mvc\model\Newpost($postTitle, $postContent);
        }
    }

    /**
     *  The action displays the make a new post
     */
    public function action() {

        $this->view = new \mvc\view\Newpost($this);
        $this->view->page();
    }

    /**
     * The title for the webpage comes from the model. 
     * The model gets the name of the category from the database as uses it as the title for the page. 
     * 
     * @return type
     */
    public function getTitle() {
        return "New Post";
    }

    public function isDataValid() {
        return $this->dataEntered;
    }

}

?>
