<?php
namespace mvc\model;

class Productspec extends Model{
    
    private $categoryURL;
    private $productID;
    
    public function __construct($productID) {
        
        parent::__construct();
                     
        $query = "SELECT * FROM products where product_id=:productID";

        if($productID)
        {
        $this->productID =  $productID;
        
        $this->prepare($query,array(':productID'=>$productID));

        $this->next();
        
        if(!$this->isDataReturned()) $this->setError("Product Is not available in Online Bbook Shop"); 
        }
        else
        {
         $this->prepare($query);   
        }       
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
    public function getSold() {
        return $this->get('product_sold');
    }

    public function getProductURL() {
        return $this->get('product_url');
    }
public function getProductCategory() {
        return $this->get('category');
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


    
// get product description
    public function getDescription() {
        return $this->get("product_description");
    }
// get product image
    public function getImage() {
        return $this->get("product_image");
    }
 
 
 public function getSpecificationURL()
 {
     return $this->getCategoryURL() . '/' . $this->getId();
 }
}

?>
