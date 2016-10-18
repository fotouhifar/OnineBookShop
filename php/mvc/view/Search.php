<?php

namespace mvc\view;

class Search extends View {

    public function body($product) {

        extract($_POST);
        if (!isset($SortBy)) {
            $SortBy = 0;
        }
        if (!isset($search))
            $search = '';
//        echo "SortBy = $SortBy";

        if (!isset($PriceRange)) {
            $PriceRange = 0;
        }
        //     echo "<br> PriceRange = $PriceRange";

        if (!isset($PageNumber)) {
            $PageNumber = 1;
        }
        if (!isset($NoItems)) {
            $NoItems = 16;
        }
        if (!isset($TurnPage))
            $TurnPage = 'First';
        if (isset($TurnPage)) {
            if ($TurnPage == 'Next')
                $PageNumber++;
            if ($TurnPage == 'Pre' && $PageNumber > 1)
                $PageNumber--;
            if ($TurnPage == 'Pre' && $PageNumber <= 1) {
                $PageNumber = 1;
                $TurnPage = 'First';
            }
        }
        if (!isset($search)) {
            $search = '';
        }
        ?>
        <article id="fullArticle">
            <!--   CONTENT TITLE          -->

            <div id="pageTitle"><p><?= $product->getSearchTitle() ?><b> <?= $search ?></b></p></div>
            <div id="CustomiseSearch">
                <form action="" method="post">

                    <input class="invisibleInput" name="NoItems" value="<?= $NoItems ?>" style="visibility: hidden">
                    <input class="invisibleInput" name="search" value="<?= $search ?>" style="visibility: hidden">
                    <input class="invisibleInput" name="PageNumber" value="<?= $PageNumber ?>" style="visibility: hidden">

                    <button id="RefineSearch" type="submit">Refine List</button>

                    <div>       
                        <select name="PriceRange" class="DropDownBox">
                            <option value=0 <?PHP if ($PriceRange == 0) echo "selected"; ?>>Any Price</option>
                            <option value=1 <?PHP if ($PriceRange == 1) echo "selected"; ?>>Under $5 Items</option>
                            <option value=2 <?PHP if ($PriceRange == 2) echo "selected"; ?>>$5 To $9.99</option>
                            <option value=3 <?PHP if ($PriceRange == 3) echo "selected"; ?>>$10 To $14.99</option>
                            <option value=4 <?PHP if ($PriceRange == 4) echo "selected"; ?>>$15 To $19.99</option>
                            <option value=5 <?PHP if ($PriceRange == 5) echo "selected"; ?>>$20 To $29.99</option>
                            <option value=6 <?PHP if ($PriceRange == 6) echo "selected"; ?>>$30 To $49.99</option>
                            <option value=7 <?PHP if ($PriceRange == 7) echo "selected"; ?>>Over $50 Items</option>
                        </select>  
                    </div>

                    <div>      
                        <select name="NoItems" class="DropDownBox">
                            <option value=16 <?PHP if ($NoItems == 16) echo "selected"; ?>>16 Items per Page</option>
                            <option value=32 <?PHP if ($NoItems == 32) echo "selected"; ?>>32 Items per Page</option>
                            <option value=64 <?PHP if ($NoItems == 64) echo "selected"; ?>>64 Items per Page</option>
                            <option value=128 <?PHP if ($NoItems == 128) echo "selected"; ?>>128 Items per Page</option>
                        </select>  
                    </div>


                    <div>
                        <select name="SortBy" class="DropDownBox">
                            <option value=0 <?PHP if ($SortBy == 0) echo "selected"; ?>>Sort by ....</option>
                            <option value=1 <?PHP if ($SortBy == 1) echo "selected"; ?>>Price low to high</option>
                            <option value=2 <?PHP if ($SortBy == 2) echo "selected"; ?>>Price high to low</option>
                            <option value=3 <?PHP if ($SortBy == 3) echo "selected"; ?>>Title (A to Z)</option>
                            <option value=4 <?PHP if ($SortBy == 4) echo "selected"; ?>>Title (Z To A)</option>
                            <option value=5 <?PHP if ($SortBy == 5) echo "selected"; ?>>Author (A to Z)</option>
                            <option value=6 <?PHP if ($SortBy == 6) echo "selected"; ?>>Author (Z To A)</option>
                        </select> 
                    </div>
                </form>
            </div>


            <!--          Product Search Result list       -->    
            <?PHP
            $counter = ($PageNumber - 1) * $NoItems + 1;
            for ($i = 0; $i < ($PageNumber - 1) * $NoItems; $i++) {
                $product->next();
            }
            while ($product->next() && $counter <= ($PageNumber * $NoItems)) {
                ?>
                <div class="LargeProduct">
                    <a href="<?= PROJECT_URL . 'productspec' . '/' . $product->getSpecificationURL() ?>">
                        <div class="ProductImage">
                            <img alt="Image alt comes here" src="<?= PRODUCTIMAGE . $product->getProductImage(); ?>">
                            <br>
                            <p style="font-size: 0.9em;">
                                <?PHP
                                if ($product->getProductDate() > '1000-01-01')
                                    echo $product->getProductDate();
                                ?>
                            </p>
                            $ <?= $product->getProductPrice(); ?>
                            <br>

                            <?PHP
                            if ($product->getProductInStock() > 0)
                                echo "<p id='InStock'>In Stock (" . $product->getProductInStock() . ")</p>";
                            else
                                echo "<p id='OutOfStock'>Out Of Stock</p>";
                            ?>

                        </div>
                        <div class="ProductDesc" ><b><?= $product->getProductTitle(); ?></b>
                            <p style="padding: 10px;">by: </p><br><b><?= $product->getProductAuthor(); ?></b>
                        </div>
                    </a>
                </div>
                <?PHP
                $counter++;
            }
            ?>


        </article>

        <p>
        <form id="TurnPage" method="post">
            <button 
            <?PHP
            if ($PageNumber == 1)
                echo 'disabled';
            ?>
                class="GeneralButton" type="submit" id="PreviousePage" style="float: left;" name="TurnPage" value="Pre"

                >< < < PREVIOUS</button>

            <button
            <?PHP
            if ($PageNumber * $NoItems >= $product->getRowCount())
                echo 'disabled';
            ?>
                class="GeneralButton" type="submit"  id="NextPage" style="float: right;" name="TurnPage" value="Next">NEXT > > ></button>
            <input class="invisibleInput" name="NoItems" value="<?= $NoItems ?>" style="visibility: hidden">
            <input class="invisibleInput" name="PriceRange" value="<?= $PriceRange ?>" style="visibility: hidden">
            <input class="invisibleInput" name="SortBy" value="<?= $SortBy ?>" style="visibility: hidden">
            <input class="invisibleInput" name="search" value="<?= $search ?>" style="visibility: hidden">
            <input class="invisibleInput" name="PageNumber" value="<?= $PageNumber ?>" style="visibility: hidden">

        </form>

        </p>
        <?php
    }

}
?>
