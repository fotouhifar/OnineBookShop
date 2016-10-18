<?php

namespace mvc\model;

class Newsletter extends Model {


    public function __construct($nlSubject,$nlMessage) {
        parent::__construct();

        //**********************************************************************
// query to get the category name


            $query = "SELECT subscriber_email FROM subscribers";


            $this->prepare($query);
            $this->query($query);
            
            
            //            $this->executePrepare();

// test for no data
//            $this->executePrepare(":category_url", $categoryURL);
// get the next row returned from the query
          
           
            
    }

    public function getEmail() {
        return $this->get('subscriber_email');
    }

}

?>
