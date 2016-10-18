<?php

namespace mvc\model;

class Products extends Model {

    private $title = "";
    private $categoryURL;

    public function __construct($categoryURL) {
        parent::__construct();
        extract($_POST);
        if (!isset($search))
            $search = '';
        if (!isset($SortBy))
            $SortBy = 0;
        if (!isset($PriceRange))
            $PriceRange = 0;
 //       echo "sort=" . $SortBy . "price=" . $PriceRange;

        //**********************************************************************
// query to get the category name

        switch ($PriceRange) {
            case 1:
                $Where = " product_price < 5 ";
                break;
            case 2:
                $Where = " product_price >=5 AND product_price < 10 ";
                break;
            case 3:
                $Where = " product_price >=10 AND product_price < 15 ";
                break;
            case 4:
                $Where = " product_price >=15 AND product_price < 20";
                break;
            case 5:
                $Where = " product_price >=20 AND product_price < 30";
                break;
            case 6:
                $Where = " product_price >=30 AND product_price < 50";
                break;
            case 7:
                $Where = " product_price >= 50 ";
                break;

            default:
                $Where = null;
                break;
        }


        switch ($SortBy) {
            case 1:
                $OrderBy = " ORDER BY product_price ASC ";
                break;
            case 2:
                $OrderBy = " ORDER BY product_price DESC ";
                break;
            case 3:
                $OrderBy = " ORDER BY product_title ASC ";
                break;
            case 4:
                $OrderBy = " ORDER BY product_title DESC ";
                break;
            case 5:
                $OrderBy = " ORDER BY book_author ASC ";
                break;
            case 6:
                $OrderBy = " ORDER BY book_author DESC ";
                break;
            default:
                $OrderBy = "";
                break;
        }

        if ($categoryURL <> 'all') {
            $this->categoryURL = $categoryURL;

            $query = "SELECT category_title FROM categories where category_url = :category_url ";

            if ($PriceRange > 0)
                $query = $query . " AND " . $Where . $OrderBy;
            else
                $query = $query . $OrderBy;


            $this->prepare($query);
// test for no data
            $this->executePrepare(":category_url", $categoryURL);
// get the next row returned from the query
            $this->next();

            $this->title = $this->get('category_title');

            //*******************************************************************************      

            $query = "SELECT * FROM products where category_url = :category_url ";

            if ($PriceRange > 0)
                $query = $query . " AND " . $Where . $OrderBy;
            else
                $query = $query . $OrderBy;

// create a prepared statement 
            $this->prepare($query);
// test for no data
            $this->executePrepare(":category_url", $categoryURL);

            if (!$this->isDataReturned())
                $this->setError("No data for that category");
        }
        else {


//            $this->categoryURL = 'All Products';
            $this->title = 'All Products';
//*******************************************************************************      
            $query = "SELECT * FROM products ";

            if ($PriceRange > 0)
                $query = $query . " WHERE " . $Where . $OrderBy;
            else
                $query = $query . $OrderBy;


// create a prepared statement 
// test for no data
            $this->prepare($query);
// test for no data
            $this->executePrepare(":category_url", $categoryURL);
   //         echo "<br>QUERY=  " . $query;

            if (!$this->isDataReturned())
                $this->setError("No Products Found");
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
