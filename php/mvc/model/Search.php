<?php

namespace mvc\model;

class Search extends Model {

    private $title = "";
    private $NumberOfProducts = 0;

    public function __construct($keyword, $SortBy, $PriceRange) {

        parent::__construct();



        $query = "SELECT * FROM products where (book_author like :keyword OR product_title like :keyword OR product_description like :keyword)";
        //     echo "sort=" . $SortBy . "price=" . $PriceRange;

        switch ($PriceRange) {
            case 1:
                $Where = " AND product_price < 5 ";
                break;
            case 2:
                $Where = " AND product_price >=5 AND product_price < 10 ";
                break;
            case 3:
                $Where = " AND product_price >=10 AND product_price < 15 ";
                break;
            case 4:
                $Where = " AND product_price >=15 AND product_price < 20";
                break;
            case 5:
                $Where = " AND product_price >=20 AND product_price < 30";
                break;
            case 6:
                $Where = " AND product_price >=30 AND product_price < 50";
                break;
            case 7:
                $Where = " AND product_price >= 50 ";
                break;

            default:
                $Where = null;
                break;
        }


        //$Where = "";


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

        $query = $query . $Where . $OrderBy;
// create a prepared statement 
        $this->prepare($query);
// test for no data
        $this->executePrepare(":keyword", "%$keyword%");
        //      echo "<br>QUERY=  " . $query;

        if (!$this->isDataReturned())
            $this->setError("No data for that search");
    }

    public function getNumberOfProducts() {
        return $this->NumberOfProducts;
    }

    public function getSearchTitle() {
        return "Search Result For :<br>";
    }

    public function getProductId() {
        return $this->get('product_id');
    }

    public function getProductTitle() {
        return $this->get('product_title');
    }

    public function getProductAuthor() {
        return $this->get('book_author');
    }

    public function getProductDate() {
        return $this->get('periodical_date');
    }

    public function getProductImage() {
        return $this->get('product_image');
    }

    public function getProductURL() {
        return $this->get('product_url');
    }

    public function getProductCategoryURL() {
        return $this->get('category_url');
    }

    public function getProductCategory() {
        return $this->get('category');
    }

    public function getProductInStock() {
        return $this->get('product_instock');
    }

    public function getProductPrice() {
        return $this->get('product_price');
    }

    public function getProductSold() {
        return $this->get('product_sold');
    }

    public function getProductDescription() {
        return $this->get('product_description');
    }

    public function getId() {
        return $this->get('product_id');
    }

    public function getSpecificationURL() {
        return $this->getProductCategoryURL() . '/' . $this->getId();
    }

}

?>
