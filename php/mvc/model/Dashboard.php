<?php

namespace mvc\model;
class Dashboard extends Model {
    public function __construct() {
        parent::__construct();
        $_SESSION['OBSemail'];
        $em = sha1($_SESSION['OBSemail']);
        $query = "SELECT * FROM customers where customer_email = '$em'";
        $this->query($query);
        $this->next();
    }

    public function getCFirstName() {
        return $this->get('customer_first_name');
    }

    public function getCLastName() {
        return $this->get('customer_last_name');
    }

    public function getCsalt() {
        return $this->get('customer_salt');
    }
    public function getCnewsletter() {
        return $this->get('customer_newsletter');
    }

    public function getCcountry() {
        return $this->get('customer_country');
    }

    public function getCpostcode() {
        return $this->get('customer_postcode');
    }

    public function getCstate() {
        return $this->get('customer_state');
    }

    public function getCsuburb() {
        return $this->get('customer_suburb');
    }
       public function getCaddress() {
        return $this->get('customer_address');
    }
  
}
