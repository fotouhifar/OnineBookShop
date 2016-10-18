<?php

namespace mvc\model;

class Report extends Model {

    private $title = "";
    private $query = '';
    public $colTitle = array();
    public $numeric = array();
    public $colActualTitle = array();
    public $colCount = 0;

    public function __construct($queryNo) {


        parent::__construct();

        /*
          if (isset($queryNo))
          if (isset($queryNo)) {
          echo $queryNo;
          }
         */

        extract($_POST);
        /*
          if (isset($monthInput))
          echo $monthInput;
         */

        if ($queryNo > 0 && $queryNo <= 8) {
            switch ($queryNo) {
                case '1':
                    $this->numeric = array(0, 0, 0, 1, 1);
                    $this->colTitle = array('#', 'TITLE', 'CATEGORY', 'PRICE', 'QTY');
                    $this->colActualTitle = array('product_id', 'product_title', 'category_url', 'product_price', 'quantity_ordered');
                    $query = "SELECT order_line.product_id, product_title,category_url, products.product_price, SUM(quantity) AS quantity_ordered  FROM order_line, products  WHERE order_line.product_id = products.product_id
GROUP BY order_line.product_id
ORDER BY quantity_ordered DESC";
                    break;
                case '2':
                    $this->numeric = array(0, 0, 0, 1, 1);
                    $this->colTitle = array('#', 'TITLE', 'CATEGORY', 'PRICE', 'QTY');
                    $this->colActualTitle = array('product_id', 'product_title', 'category_url', 'product_price', 'quantity_ordered');
                    $query = "SELECT order_line.product_id, product_title,category_url, products.product_price, SUM(quantity) AS quantity_ordered  FROM order_line, products  WHERE order_line.product_id = products.product_id
GROUP BY order_line.product_id
ORDER BY quantity_ordered ASC";
                    break;
                case '3':
                    $this->numeric = array(0, 1);
                    $this->colTitle = array('STATE', 'NUMBER OF CUSTOMERS');
                    $this->colActualTitle = array('customer_state', 'count(*)');
                    $query = "SELECT customer_state , count(*) 
FROM customers 
GROUP BY customer_state
order BY count(*)";
                    break;
                case '4':
                    $this->numeric = array(0,0,0,1,1);
                    $this->colTitle = array('#', 'FIRST NAME', 'LAST NAME', 'TOTAL AMOUNT', 'TOTAL QUANTITY');
                    $this->colActualTitle = array('customer_id', 'customer_first_name', 'customer_last_name', 'TOTAL_AMOUNT', 'TOTAL_QUANTITY');
                    $query = "SELECT orders.customer_id, customer_first_name, customer_last_name, ROUND(SUM(order_line.product_price),2) AS TOTAL_AMOUNT, SUM(quantity) AS TOTAL_QUANTITY
FROM orders, customers, order_line
WHERE order_line.order_id = orders.order_id
AND orders.customer_id = customers.customer_id
GROUP BY orders.customer_id
ORDER BY TOTAL_AMOUNT DESC";
                    break;
                case '5':
                    $this->numeric = array(0,0,1,1);
                    $this->colTitle = array('MONTH', 'YEAR', 'ORDERS', 'TOTAL SOLD');
                    $this->colActualTitle = array('thismonth', 'thisyear', 'amountsold', 'totalsold');
                    $query = "SELECT MONTHNAME(order_date) AS thismonth, YEAR(order_date) AS thisyear, count(order_date) AS amountsold,
round(sum(order_line.product_price),2) AS totalsold
FROM orders, order_line
WHERE order_line.order_id=orders.order_id
GROUP BY thismonth,thisyear
ORDER BY thisyear
";

                    break;
                case '6':
                    $this->numeric = array(0,1,1);
                    $this->colTitle = array('CATEGORY', 'QTY', 'TOTAL');
                    $this->colActualTitle = array('category_url', 'QTY', 'total');
                    $query = "";
                    break;
                case '7':
                    $this->numeric = array(0,1,1);
                    $this->colTitle = array('CATEGORY', 'QTY', 'TOTAL');
                    $this->colActualTitle = array('category_url', 'QTY', 'total');
                    $query = "SELECT category_url, SUM( quantity) AS QTY,
sum(round((quantity*order_line.product_price),2))AS total
FROM products, order_line
WHERE products.product_id = order_line.product_id
GROUP BY category_url
ORDER BY total DESC";
                    break;
                case '8':
                    $this->numeric = array(0,0,1,1,1);
                    $this->colTitle = array('#', 'TITLE', 'PRICE', 'QTY', 'TOTAL PRICE SOLD');
                    $this->colActualTitle = array('product_id', 'product_title', 'product_price', 'quantity_ordered', 'total_sold');
                    $query = "SELECT order_line.product_id, product_title, products.product_price, SUM(quantity) AS quantity_ordered , round(SUM(quantity)*products.product_price,2) as total_sold
FROM order_line, products  
WHERE order_line.product_id = products.product_id
GROUP BY order_line.product_id
ORDER BY total_sold DESC";
                    break;
            }

            $this->query($query);
            $this->colCount = $this->getColCount();
        }
    }

    public function getDataCell($key) {
        return $this->get($key);
    }

    public function getQueryNumber() {
        return $this->queryNo;
    }

}

?>
