<?php

namespace mvc\model;

class Cart extends Productspec {
    public $cart;
    private $invoice;
    private $productIds;
    private $productIndex = 0;
    private $currentId = 0;
    private $total = 0;
    private $instockExceeded = false;

    public function __construct($cart,  $productID, $quantity = 1) {

        $this->cart = $cart;

        parent::__construct($productID);
        
    

        if ($quantity == 0) {

            unset($this->cart[$productID]);
            
        } else if ($this->isDataReturned()) {

       
                $this->cart[$productID] = $quantity;
        }

        $this->productIds = array_keys($this->cart);
    }

    public function getCart() {
        return $this->cart;
    }

    public function nextProduct() {
        $this->currentId = null;

        if (isset($this->productIds[$this->productIndex])) {
            $this->currentId = $this->productIds[$this->productIndex];

          $this->prepareBind(array(':productID' => $this->currentId));

            $this->productIndex++;

            if ($this->next()) {
                $this->total += $this->getSubtotal();
                $this->stockExceeded();
                return true;
            }
        }

        return false;
    }

    public function getSubtotal() {
        return $this->cart[$this->currentId] * $this->getPrice();
    }

    public function getFormattedSubtotal() {
        return number_format($this->cart[$this->currentId] * $this->getPrice(), 2);
    }

    public function getQuantity() {
        
        return intval($this->cart[$this->currentId]);
        
    }

    public function getTotal() {
        return $this->total;
    }

    public function getFormattedTotal() {
        return number_format($this->total, 2);
    }

    public function stockExceeded() {
        $exceeded = $this->getInStock() < $this->getQuantity();

        $this->instockExceeded |= $exceeded;

        if ($exceeded) {
            $this->setError("a quantity in the cart exceeds the available stock");
        }
        return $exceeded;
    }

    public function cartExceedsStock() {
        return $this->instockExceeded;
    }

    public function getProductCount() {
        return count($this->cart);
    }

    public function setInvoice($invoice) {
        $this->invoice = $invoice;
    }

    public function getInvoice() {
        return $this->invoice;
    }

}

?>
