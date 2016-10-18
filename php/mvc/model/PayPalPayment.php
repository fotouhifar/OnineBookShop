<?php

namespace mvc\model;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PayPalPayment
 *
 * @author ppayne
 */
class PayPalPayment extends Cart {

    private $payment = null;

    public function __construct($pid, $cart) {

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

        try {

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

// ### Payer
// A resource representing a Payer that funds a payment
// For paypal account payments, set payment method
// to 'paypal'.
            $payer = new Payer();
            $payer->setPaymentMethod("paypal");

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it. 
            $transaction = new Transaction();
            $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription("payment id " + $pid);
// ### Redirect urls
// Set the urls that the buyer must be redirected to after 
// payment approval/ cancellation.
            $baseUrl = PROJECT_URL;
            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl($baseUrl . "ExecutePayment?success=true")
                    ->setCancelUrl($baseUrl . "ExecutePayment?success=false");

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
            $payment = new \PayPal\Api\Payment();
            $payment->setIntent("sale")
                    ->setPayer($payer)
                    ->setRedirectUrls($redirectUrls)
                    ->setTransactions(array($transaction));

// ### Create Payment
// Create a payment by calling the 'create' method
// passing it a valid apiContext.
// (See bootstrap.php for more on `ApiContext`)
// The return object contains the state and the
// url to which the buyer must be redirected to
// for payment approval



            $payment->create($apiContext);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            echo'{"error":"Unable to contact PayPal. Your cart has been saved. Please try again later."}';

            exit();
        }



// ### Get redirect url
// The API response provides the url that you must redirect
// the buyer to. Retrieve the url from the $payment->getLinks()
// method
        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {
                $redirectUrl = $link->getHref();
                break;
            }
        }

// ### Redirect buyer to PayPal website
// Save the payment id so that you can 'complete' the payment
// once the buyer approves the payment and is redirected
// back to your website.
//
// It is not a great idea to store the payment id
// in the session. In a real world app, you may want to 
// store the payment id in a database.
        $_SESSION['paypalId'] = $payment->getId();

        if (isset($redirectUrl)) {

//                 header("Location:http://www.nasa.gov/");
//	header("Location: $redirectUrl");
            //              echo $redirectUrl;
            echo'{"href":"' . $redirectUrl . '"}';
        }
    }

    public function getPayPalPaymentId() {
        return ($this->payment) ? $this->payment->getId() : '';
    }

}

