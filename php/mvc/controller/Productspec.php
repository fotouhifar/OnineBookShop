<?php
namespace mvc\controller;


class Productspec extends Controller{
   
    /**
     * @param string $url
     */
    
    public function __construct($url) {
        parent::__construct();
       // url[1] is the category URL
       // url[2] is the product ID 
       $this->model = new \mvc\model\Productspec($url[2]);
    }

  /**
  *  The action displays the Specifications page
  */
    
    public function action() {
        
        $this->view = new \mvc\view\Productspec($this);
        $this->view->page();
             
    }

    /**
     * @return type
     */
    
    public function getTitle() {
        return $this->model->getName();
    }
}

?>
