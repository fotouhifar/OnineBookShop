<?php

namespace mvc\model;

class Checkout extends Cart {

//    private $problem = false;
    private $salt = 'xxx';
    private $saltedPassword = 'no salt';
    private $signedIn = false;

//    private $orderID=0;
//    private $cart;

    public function __construct($cart) {
        parent::__construct($cart,"",0);

        /*
          try {
          //        $this->startTransaction();


          $this->cart = $_SESSION['OBScart'];
          $query = "INSERT INTO orders(customer_id) VALUES (:id)";

          $this->prepare($query, array(':id' => $_SESSION['OBSid']));
          $this->orderID = $this->getLastId();

          foreach ($this->cart as $key => $value) {


          // Restore the product price
          $query = "SELECT product_price FROM products WHERE product_id=$key";
          $this->query($query);
          $this->next();
          $product_price = $this->get('product_price');

          //*****************************

          $query = "INSERT INTO order_line(order_id, product_id, quantity,product_price) VALUES (:orderID,:productID,:quantity,:product_price)";

          $this->prepare($query, array(
          ':orderID' => $this->orderID,
          ':productID' => $key,
          ':quantity' => $value,
          ':product_price' => $product_price
          ));

          //@ REMOVE THIS LINE!
          //     echo $key . "=>" . $value . "<br>";
          //              $this->commit();
          }

          $this->emptyCart();
          //         $_SESSION['OBScart']=null;

          } catch (PDOException $ex) {

          error_log($ex->getMessage());
          $this->problem = true;
          $this->setError("Unable to finalize purchase.");
          $this->rollBack();
          }


         */
    }

    public function isProblem() {
        return $this->proble;
    }

    public function emptyCart() {

        $_SESSION['OBScart'] = array();
    }

}

?>
