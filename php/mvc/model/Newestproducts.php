<?php

namespace mvc\model;

class Newestproducts extends Model {

    private $title = "";
    private $categoryURL;

    public function __construct($product) {
        parent::__construct();


            //*******************************************************************************      
           
            
            $query = "SELECT * FROM products ORDER BY product_id DESC";
// create a prepared statement 
            $this->prepare($query);

            if (!$this->isDataReturned())
                $this->setError("No data for that category");
//            $this->categoryURL = 'All Products';
            $this->title = 'Newest Products';

    }

    public function getTitle() {
        return $this->title;
    }

    public function getProductTitle() {
        return $this->get('product_title');
    }

    public function getAuthor() {
        return $this->get('book_author');
    }

    public function getId() {
        return $this->get('product_id');
    }

    public function getPrice() {
        return $this->get('product_price');
    }

    public function getName() {
        return $this->get('product_title');
    }

    public function getInStock() {
        return $this->get('product_instock');
    }

    public function getProductURL() {
        return $this->get('product_url');
    }

    public function getProductImage() {
        return $this->get('product_image');
    }

    public function getCategoryURL() {
        return $this->get('category_url');
    }

    public function getPeriodicalDate() {
        return $this->get('periodical_date');
    }

    public function getSpecificationURL() {
        return $this->getCategoryURL() . '/' . $this->getId();
    }

}

?>
