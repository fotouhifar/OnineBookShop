<?php
namespace mvc\controller;

class Newstproducts extends Controller{
    public function __construct($url) {
        parent::__construct();
        // 
            $this->model = new \mvc\model\Newstproducts;
    }

  /**
  *  The action displays the Products page
  */
    
    public function action() {
        $this->view = new \mvc\view\Newstproducts($this);
        $this->view->page();
    }

    /**
     * The title for the webpage comes from the model. 
     * The model gets the name of the category from the database as uses it as the title for the page. 
     * 
     * @return type
     */
    public function getTitle() {
        return $this->model->getTitle();
    }
}

?>
