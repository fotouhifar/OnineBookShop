<?php

namespace mvc\model;

class Register extends Model {

    public function __construct($fn, $ln, $em, $pw, $nl, $ad, $sb, $st, $pc, $cr) {

// run constructor in Model
        parent::__construct();

        if ($nl == '1') {

            $this->model = new \mvc\model\Subscribe($em);
//            $query = "INSERT INTO subscribers  set  subscriber_email=:em";
            //          $this->prepare($query, array(':em' => $em));
        }


        $salt = uniqid(mt_rand(), true);
        $pw = sha1($pw . $salt);
        $em = sha1($em);


        $query = "SELECT customer_id FROM customers  WHERE 
            customer_email=:em;";


        $this->prepare($query, array(
            ':em' => $em));

        if ($this->isDataReturned())
            $this->setError("Customer Exist. Duplicated Email address is not allowed to register again!");
        else {
            $this->setEventMsg("Customer Registered successfully");

            $query = "INSERT INTO customers  set
            customer_first_name=:fn,
            customer_last_name=:ln,
            customer_email=:em,
            customer_password=:pw ,
            customer_address=:ad ,
            customer_suburb=:sb,
            customer_state=:st,
            customer_postcode=:pc,
            customer_country=:cr,
            customer_salt=:salt;";


            ($this->prepare($query, array(
                        ':fn' => $fn,
                        ':ln' => $ln,
                        ':em' => $em,
                        ':pw' => $pw,
                        ':ad' => $ad,
                        ':sb' => $sb,
                        ':st' => $st,
                        ':pc' => $pc,
                        ':cr' => $cr,
                        ':salt' => $salt)));
        }
    }

}

?>
