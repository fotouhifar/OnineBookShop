<?php

namespace mvc\model;

class Account extends Model {

    public $customerName = '';
    public $customerLName = '';
    public $customerCountry = '';
    public $customerPostcode = '';
    public $customerState = '';
    public $customerSuburb = '';
    public $customerAddress = '';
    private $customer_id;

    public function __construct() {

        parent::__construct();

        $_SESSION['OBSemail'];
        $em = sha1($_SESSION['OBSemail']);
        $query = "SELECT * FROM customers where customer_email = '$em'";
        $this->query($query);
        $this->next();

        $this->customerName = $this->get('customer_first_name');
        $this->customerLName = $this->get('customer_last_name');
        $this->customerCountry = $this->get('customer_country');
        $this->customerPostcode = $this->get('customer_postcode');
        $this->customerState = $this->get('customer_state');
        $this->customerSuburb = $this->get('customer_suburb');
        $this->customerAddress = $this->get('customer_address');

        $this->customerId = $this->get('customer_id');

        $query = "SELECT products.product_id, product_title, category_url, category, products.product_price, orders.order_id, customer_id, day(order_date),month(order_date),year(order_date), line_id, quantity
FROM orders, order_line , products
WHERE orders.customer_id = :id AND products.product_id = order_line.product_id
AND 
order_line.order_id = orders.order_id
ORDER BY order_date DESC";
        $this->prepare($query);
        $this->executePrepare(":id", $this->customerId);
    }

    public function getOrderID() {
        return $this->get('order_id');
    }

    public function getOrderDate() {
        return $this->get('day(order_date)').'/'.$this->get('month(order_date)').'/'.$this->get('year(order_date)');
    }

    public function getLineID() {
        return $this->get('line_id');
    }


    public function getProductID() {
        return $this->get('product_id');
    }

    public function getQuantity() {
        return $this->get('quantity');
    }

    public function getPrice() {
        return $this->get('product_price');
    }

    public function getProductTitle() {
        return $this->get('product_title');
    }

    public function getCategoryURL() {
        return $this->get('category_url');
    }
    
    public function getSpecificationURL() {
        return $this->getCategoryURL() . '/' . $this->getProductID();
    }

}

