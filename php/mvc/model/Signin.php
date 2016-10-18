<?php

namespace mvc\model;

class Signin extends Model {

    private $salt = 'xxx';
    private $saltedPassword = 'no salt';
    private $signedIn = false;
    private $signInError = false;

    public function __construct($em, $pw) {
        parent::__construct();

        $em = sha1($em);

        $query = "SELECT * from customers where customer_email='$em';";

        $this->query($query);

        if ($this->isDataReturned()) {
            $this->next();
            $this->salt = $this->get('customer_salt');
            $this->saltedPassword = sha1($pw . $this->salt);
            $this->signedIn = ($this->saltedPassword == $this->get('customer_password'));
        }
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getSaltedPassword() {
        return $this->saltedPassword;
    }

    public function isSignedIn() {
        return $this->signedIn;
    }

    public function getFirstName() {
        return $this->get('customer_first_name');
    }

    public function getType() {
        return $this->get('user_type');
    }
    

    public function getId() {
        return $this->get('customer_id');
    }
    
}

?>
