<?php
namespace mvc\model;

/**
 *  Get all the categories in the camping database and displays it 
 */

class Categories extends Model{
    public function __construct() {

        // run constructor in Model
        parent::__construct();
        
        $query = "SELECT  * from  categories";
    // execute the SQL query in the database and return an array 
     
        $this->query($query);
    }
    // get the name of the category
    
   public function getName()
    {
        return $this->get("category_name");
    }
    
    public function getImage()
    {
        return $this->get("category_image");
    }
    
    public function getId()
    {
        return $this->get("category_id");
    }
    
    public function getURL()
    {
        return $this->get("category_url");
    }  
    public function getDesc()
    {
        return $this->get("category_desc");
    }  
    public function getTitle()
    {
        return $this->get("category_title");
    }  
}

?>
