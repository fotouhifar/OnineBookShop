<?php

namespace mvc\model;

class Customers extends Model {

    public function __construct() {
        parent::__construct();

        $query = "SELECT * FROM customers";
// create a prepared statement 
        $this->prepare($query);
// test for no data
        $this->query($query);

        if (!$this->isDataReturned()) {

            $this->setError("No Customer Found");
        }
    }

    public function getCFirstname() {
        return $this->get('customer_first_name');
    }

    public function getCLastname() {
        return $this->get('customer_last_name');
    }

    public function getCId() {
        return $this->get('customer_id');
    }

    public function getCEmail() {
        return $this->get('customer_email');
    }

    public function getCPassword() {
        return $this->get('customer_password');
    }

    public function getCAddress() {
        return $this->get('customer_address');
    }

    public function getCSuburb() {
        return $this->get('customer_suburb');
    }

    public function getCState() {
        return $this->get('customer_state');
    }

    public function getCPostcode() {
        return $this->get('customer_postcode');
    }

    public function getCCountry() {
        return $this->get('customer_country');
    }

    public function getCSalt() {
        return $this->get('customer_salt');
    }
    public function getCType() {
        return $this->get('user_type');
    }
    

}

?>
