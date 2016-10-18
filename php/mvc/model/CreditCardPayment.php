<?php

namespace mvc\model;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\CreditCard;
use PayPal\Api\Payer;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Transaction;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PayPalPayment
 *
 * @author ppayne
 */
class CreditCardPayment extends Cart {

    private $payment = null;

    public function __construct($pid, $card, $cart) {

        parent::__construct($cart, '', '', 0);

        $itemList = new ItemList();

        $query = "select product_id,product_price,product_name from products where category_url=:categoryURL and product_url=:productURL";

        $this->prepare($query);

        while ($this->nextProduct()) {
            $item = new Item();

            $item->setName($this->getName())
                    ->setCurrency('USD')
                    ->setQuantity($this->getQuantity())
                    ->setPrice($this->getPrice())
                    ->setSku($this->getProductId());

            $itemList->addItem($item);
        }


        $sdkConfig = array(
            "mode" => "sandbox"
        );

            $cred = new \PayPal\Auth\OAuthTokenCredential("AXr1NhCNYj6HJhpNAKWvCtD6pJBozqDoD6dM8_Y1a8QDh1tIcTG4rz6wymMY",
                        "ECrSThBiwJcYMg-8UpR3x8LlCUZG8MhAxAXT_tpqH0By16U7KEHFua_ODZEd", $sdkConfig);


        $accessToken = $cred->getAccessToken(array('mode' => 'sandbox'));

        //     $accessToken = $oa->getAccessToken(array('mode'=>'sandbox'));
//$cred = "Bearer A0150rExqCF5JItbkTtjZUaEYDpxB6taMZKkS8BcC6jkxSE";
        $apiContext = new \PayPal\Rest\ApiContext($cred, 'Request' . time());
        $apiContext->setConfig($sdkConfig);



        // ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
        $shipping = '2.50';
        $tax = '1.30';

        $details = new Details();
        $details->setShipping($shipping)
                ->setTax($tax)
                ->setSubtotal(number_format($this->getTotal(), 2));

        // ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
        $amount = new Amount();
        $amount->setCurrency("USD")
                ->setTotal(number_format(($shipping + $tax + $this->getTotal()), 2))
                ->setDetails($details);
        // ### FundingInstrument
// A resource representing a Payer's funding instrument.
// For direct credit card payments, set the CreditCard
// field on this object.
        $fi = new FundingInstrument();
        $fi->setCreditCard($card);

// ### Payer
// A resource representing a Payer that funds a payment
// For direct credit card payments, set payment method
// to 'credit_card' and add an array of funding instruments.
        $payer = new Payer();
        $payer->setPaymentMethod("credit_card")->setFundingInstruments(array($fi));

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it. 
        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription("payment id " + $pid);

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to sale 'sale'
        $this->payment = new \PayPal\Api\Payment();
        $this->payment->setIntent("sale")
                ->setPayer($payer)
                ->setTransactions(array($transaction));

// ### Create Payment
// Create a payment by calling the payment->create() method
// with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// The return object contains the state.
        try {
            $this->payment->create($apiContext);
        } catch (PayPal\Exception\PPConnectionException $ex) {
            echo "Exception: " . $ex->getMessage() . PHP_EOL;
            var_dump($ex->getData());
            exit(1);
        }
    }

    public function getPayPalPaymentId() {
        return ($this->payment) ? $this->payment->getId() : '';
    }

}

