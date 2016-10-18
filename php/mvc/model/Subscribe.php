<?php

namespace mvc\model;

class Subscribe extends Model {

    public function __construct($em) {
        parent::__construct();

//        $em = sha1($em);

        $query = "SELECT subscriber_email from subscribers where subscriber_email='$em';";
        $this->query($query);

        if ($this->isDataReturned()) {
            $query = "DELETE FROM subscribers WHERE subscriber_email='$em';";
            $this->setEventMsg("Email successfully REMOVED from newsletter");
        } else {
            $query = "INSERT INTO subscribers  set  subscriber_email='$em';";
            $this->setEventMsg("Email successfully registered in newsletter");
        }
        
        
        
        $this->query($query);
    }

}

?>
