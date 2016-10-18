<?php
namespace mvc\model;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
use PDOException;
/**
 * Description of Checkout
 *
 * @author ppayne
 */
class Payment extends Model{
    
    private $purchaseId = '';
    
    public function __construct($id, $cart) {
        parent::__construct();
        
        try{
        $this->startTransaction();

        $query = "insert into purchases set customer_id = $id";
        
        $this->execute($query);
        if($this->isError()) throw new PDOException();
        
        $this->purchaseId = $this->getLastId();
         
        foreach($cart as $pid => $quantity)
        {
            $url = explode('/',$pid);
            
            $categoryURL = $url[0];
            $productURL = $url[1];
            
            $query = "select product_id,product_price from products where category_url='$categoryURL' and product_url='$productURL'";
            
            $this->query($query);
            if($this->isError()) throw new PDOException();
                  
            $this->next();
            
            $productId = $this->get('product_id');
            $productPrice = $this->get('product_price');
             
            $insert = "insert into orders set purchase_id=$this->purchaseId, product_id=$productId,orders_price=$productPrice,orders_quantity=$quantity";
            
            $this->execute($insert);
            if($this->isError()) throw new PDOException();
        }
               
        $this->commit();
        }catch(PDOException $ex)
        {
            error_log($ex->getMessage());
            $this->purchaseId = '';
            $this->setError("unable to finalize purchase.");
            $this->rollBack();
        }
    }
        
    public function getPurchaseId()
    {
        return $this->purchaseId;
    }
}

?>
