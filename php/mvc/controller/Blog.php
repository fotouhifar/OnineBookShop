<?php
namespace mvc\controller;
/**
 * Products controller generates a webpage that displays all the products of a particular category
 * The category is specified in the URL from the browser e.g.
 * <ul>
 * <li>products/tents</li>
 * <li>products/sleeping-bags</li> 
 * </ul>
 * 
 * The URL has two components <b>class name</b>/<b>category</b>.
 * 
 * The url is read by the bootstrap file and its separate components are place in an
 *  array and passed to this constructor given to the constructor. 
 * 
 */

class Blog extends Controller{
   
    /**
     * The constructor accepts an array, from the bootstrap file, that contains 
     * the components of the URL sent by the browser.
     * 
     * $url[1] is the category to be displayed
     * 
     * The category is passed to teh Model class Products to get all the products of a particular  category.
     * 
     * @param string $url
     */
    
    public function __construct($url) {
        parent::__construct();
        // 
     
            $this->model = new \mvc\model\Blog($url);
    }

  /**
  *  The action displays the Products page
  */
    
    public function action() {
        $this->view = new \mvc\view\Blog($this);
        $this->view->page();
    }

    public function getTitle() {
        return "Blog";
    }
}

?>
