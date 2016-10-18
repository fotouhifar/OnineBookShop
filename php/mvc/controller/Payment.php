<?php

namespace mvc\controller;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use PayPal\Api\CreditCard;

/**
 * Description of Checkout
 *
 * @author ppayne
 */
class Payment extends Controller {

    public function __construct() {

        parent::__construct();
// read payment type either paypal or credit card
        $paymentType = filter_input(INPUT_POST, 'payment_type');
  
// if there is no purchase id in the session then save the current cart to the database            

            if (!$this->getPurchaseId()) {
                $this->payment = new \mvc\model\Payment($this->getId(), $this->cart);
                if (!$this->payment->isError()) {
                    $this->setPurchaseId($this->payment->getPurchaseId());
                }
            }
            // if we have a purchase ID proceed to PayPal

            if ($this->getPurchaseId()) {
                if ($paymentType == 'paypal') {
                    $this->PayPal = new \mvc\model\PayPalPayment($this->getPurchaseId(), $this->cart);
                }
                
           if ($paymentType == 'credit card') {
                    $fname = filter_input(INPUT_POST, 'fname_cc');
                    $lname = filter_input(INPUT_POST, 'lname_cc');
                    $type = filter_input(INPUT_POST, 'type');
                    $creditCardNumber = filter_input(INPUT_POST, 'cc');
                    $cvv = filter_input(INPUT_POST, 'cvv');
                    $month = filter_input(INPUT_POST, 'month');
                    $year = filter_input(INPUT_POST, 'year');

                     $validData = ($creditCardNumber && $cvv && $month && $year);

                    if ($validData) {
                    
                    $card = new CreditCard();
                    $card->setType($type)
                            ->setNumber($creditCardNumber)
                            ->setExpireMonth($month)
                            ->setExpireYear($year)
                            ->setCvv2($cvv)
                            ->setFirstName($fname)
                            ->setLastName($lname);


                    $this->PayPal = new \mvc\model\CreditCardPayment($this->getPurchaseId(), $this->cart);
                    }
                }

                $this->clearCart();
            } else {
                $this->error = $this->payment->getError();
            }   
    }

    public function action() {
        //   $this->view = new \mvc\view\Payment($this);
        //   $this->view->page();
    }

    public function getTitle() {

        return "checkout";
    }

}

?>
