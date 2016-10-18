<?php
namespace mvc\model;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExecutePayment
 *
 * @author Paul
 */
class ExecutePayment extends Model{
    
    
    public function __construct($purchaseId,$PayPalId,$status) {
        parent::__construct();
                
        switch($status)
        {
            case('pending'): $purchase_status = 'pending_approval';break;
            case('complete'): $purchase_status = 'approved';break;
            default:  $purchase_status = 'no_approval' ;  
        }
        
        $query = 'update purchases set paypal_id=:paypal_id, purchase_status=:purchase_status where purchase_id = :purchase_id';
     
        $this->prepare($query,array(':paypal_id'=>$PayPalId,'purchase_status'=>$purchase_status,":purchase_id"=>$purchaseId));
        
    }
     
}
