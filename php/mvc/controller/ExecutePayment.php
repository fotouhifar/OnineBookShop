<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mvc\controller;

use Exception;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

/**
 * Description of ExecutePayment
 *
 * @author Paul
 */
class ExecutePayment extends Controller {

    private $result = null;

    public function __construct($url) {
        parent::__construct();


        $success = filter_input(INPUT_GET, 'success');
        $payerId = filter_input(INPUT_GET, 'PayerID');


        if ($success == 'true' && $payerId) {
            try {

                // increase the default timout from 30 to 300 seconds
                \PayPal\Core\PPConfigManager::mergrDefaults(array("http.ConnectionTimeOut" => "300"));

  
                $sdkConfig = array("mode" => "sandbox");

                $cred = new \PayPal\Auth\OAuthTokenCredential("AXr1NhCNYj6HJhpNAKWvCtD6pJBozqDoD6dM8_Y1a8QDh1tIcTG4rz6wymMY", "ECrSThBiwJcYMg-8UpR3x8LlCUZG8MhAxAXT_tpqH0By16U7KEHFua_ODZEd", $sdkConfig);
                //      $accessToken =  $cred->getAccessToken(array('mode'=>'sandbox'));
                $paymentId = $_SESSION['paypalId'];
 
                

//  $cred = filter_input(INPUT_GET,'token');  
//$cred = "Bearer A0150rExqCF5JItbkTtjZUaEYDpxB6taMZKkS8BcC6jkxSE";
                $apiContext = new \PayPal\Rest\ApiContext($cred, 'Request' . time());
                $apiContext->setConfig($sdkConfig);

// Get the payment Object by passing paymentId
                // payment id was previously stored in session in
                // CreatePaymentUsingPayPal.php

                $payment = Payment::get($paymentId, $apiContext);

                // PaymentExecution object includes information necessary 
                // to execute a PayPal account payment. 
                // The payer_id is added to the request query parameters
                // when the user is redirected from paypal back to your site

                $execution = new PaymentExecution();
                $execution->setPayerId($_GET['PayerID']);

                //Execute the payment
                // (See bootstrap.php for more on `ApiContext`)
                $this->result = $payment->execute($execution, $apiContext);
                
                echo $this->result->getState();
                
                
                $this->model = new \mvc\model\ExecutePayment($this->getPurchaseId(),$this->result->getId(),$this->result->getState());
   
                } catch (\PayPal\Exception\PPConnectionException $ex) {

                        $data = json_decode($ex->getData());

                       //$this->error =  $data->message;
                        
                      $this->error = "There was a problem displaying receipt information";  
                       
                    } catch (Exception $ex) {

                        $this->error =  $ex->getMessage();
                    }
                } else {
                   $this->error =  "User cancelled payment.";
                }
            }

            public function action() {
                $this->view = new \mvc\view\ExecutePayment($this);
                $this->view->page();
            }

            public function getTitle() {
                return 'Payment Complete';
            }

            public function getPayment() {
                return $this->result;
            }

            public function getPayer() {
                return ($this->result)?$this->result->getPayer()->getPayerInfo():null;
            }

        }
        