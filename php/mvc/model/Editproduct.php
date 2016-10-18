<?php

namespace mvc\model;

class Editproduct extends Model {

    private $PCategoryURL = '1';

    public function __construct($PId, $PTitle, $PAuthor, $PDescription, $PDate, $PImage, $PCategory, $PInstock, $PPrice, $PSold) {
        parent::__construct();
//        $em = sha1($em);
        switch ($PCategory) {
            case '1':
                $PCategoryURL = 'e-readers';
                break;
            case '2':
                $PCategoryURL = 'books';
                break;
            case '3':
                $PCategoryURL = 'e-books';
                break;
            case '4':
                $PCategoryURL = 'accessories';
                break;
            case '5':
                $PCategoryURL = 'stationeries';
                break;
            case '6':
                $PCategoryURL = 'periodicals';
                break;
            case '7':
                $PCategoryURL = 'audibles';
                break;
            case '8':
                $PCategoryURL = 'gifts';
                break;
        }


//        $PDescription = addcslashes($PDescription, '\\,\',\", ' );
        $PDescription = addslashes($PDescription);
        str_replace("\n,\r", "\r\n", $PDescription);


        $query = "UPDATE products set "
                . "product_title= '$PTitle', "
                . "book_author='$PAuthor', "
                . "product_description='$PDescription', "
                . "periodical_date='$PDate', "
                . "product_image='$PImage', "
                . "category='$PCategory',  "
                . "category_url='$PCategoryURL',     "
                . "product_instock='$PInstock', "
                . "product_price='$PPrice', "
                . "product_sold='$PSold' "
                . "WHERE product_id = $PId";


        $this->query($query);
    }

}

?>
