<?php

namespace mvc\model;

class Editcustomer extends Model {

    public function __construct($editquery, $id, $fn, $ln, $ad, $sb, $st, $pc, $cr, $type) {
        parent::__construct();

//        $em = sha1($em);

        if ($editquery == 'edit') {
            $query = "UPDATE customers set 
customer_first_name= '$fn',
customer_last_name='$ln',
customer_address='$ad',
customer_suburb='$sb',
customer_state='$st',
customer_postcode='$pc',
customer_country='$cr',
user_type='$type' 
WHERE customer_id = $id";
        } elseif ($editquery == 'delete') {
            $query = "DELETE FROM customers
WHERE customer_id = $id";
        }


        $this->query($query);
    }

}

?>
