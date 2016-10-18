<?php

namespace mvc\view;

class Productspec extends View {

    public function body($product) {
        ?>
        <article id="fullArticle">
            <!--   CONTENT TITLE          -->

            <div id="pageTitle"><p>Product Details</p></div>


            <div id="ProductImages">
                <p>
                    <img src="<?= PRODUCTIMAGE . $product->getImage() ?>">
                </p>
                <p class="ProductSpecDetails2">
                    PRICE <br> $ <?= $product->getPrice() ?>
                </p>
                <?PHP
                if ($product->getInStock() > 0) {
                    echo "<p class='ProductSpecDetails2' style='color:#00FF00;'> In Stock<br>(" . $product->getInStock() . ")</p>";
                } else {
                    echo "<p class='ProductSpecDetails2'  style='color:#FFFF00;'>Product is not available!</p>";
                }
                ?>
                <p class="ProductSpecDetails2">Sold<br>(<?= $product->getSold() ?>)
                    <br>
                </p>

                <a href="<?= PROJECT_URL . 'cart' . '/' . $product->getSpecificationURL() ?>"><button class="GeneralButton"
                    <?PHP
                    if ($product->getInStock() == 0) {
                        echo "disabled>  Not Available";
                    } else {
                        echo ">  Add To Cart";
                    }
                    ?>
                </button></a>
        </div>

        <div id="ProductDescription">
            <p class='ProductSpecDetails'> 
                Title: <?= $product->getProductTitle() ?>
                <?PHP
                if ($product->getAuthor())
                    echo "<p class='ProductSpecDetails'>  Author: " . $product->getAuthor() . '</p>';
                if ($product->getPeriodicalDate() > '0000-00-00')
                    echo "<p class='ProductSpecDetails'>Date: " . $product->getPeriodicalDate() . '</p>';
                ?>
            </p>

            <p><?= $product->getDescription() ?>
                <br>
            </p>
            <p>
                <?PHP
                if ($_SESSION['OBSusertype'] == 'admin') {
                    ?>
                    <a href="<?= PROJECT_URL ?>editproduct"></a><button class="GeneralButton" onclick="editProduct()">Edit Product</button>
                    <?PHP
                }
                ?>
            </p>
        </div>
        </article>

        <!--   EDIT PRODUCT   -->



        <div id="pageTitle2"><p>Edit Product</p></div>
        <form id="editProductForm" onsubmit="validateProductForm()" action="<?= PROJECT_URL ?>editproduct" method="post">

            <article class="HiddenFullArticle">
                <input name="PId" value="<?= $product->getId() ?>" style="visibility: hidden">
                <p>Title <br><input name="PTitle" value="<?= $product->getProductTitle() ?>" required></p>
                <p>Book Author (If applicable)  <br><input name="PAuthor" value="<?= $product->getAuthor() ?>"></p>

                <p>Item description<br><textarea name="PDescription"><?= $product->getDescription() ?></textarea></p>



                <p>Periodical Date (If applicable) <br> <input name="PDate"  type="date" value="<?= $product->getPeriodicalDate() ?>"></p>
                <p>Image <br> <input name="PImage"  value="<?= $product->getImage() ?>"></p>
                <p>Category<br>
                    <select name="PCategory" required>
                        <option value="1" <?PHP if ($product->getProductCategory() == '1') {
            echo 'selected';
        } ?>>E-book readers</option>
                        <option value="2" <?PHP if ($product->getProductCategory() == '2') {
            echo 'selected';
        } ?>>Books</option>
                        <option value="3" <?PHP if ($product->getProductCategory() == '3') {
            echo 'selected';
        } ?>>E-books</option>
                        <option value="4" <?PHP if ($product->getProductCategory() == '4') {
            echo 'selected';
        } ?>>Reader accessories</option>
                        <option value="5" <?PHP if ($product->getProductCategory() == '5') {
            echo 'selected';
        } ?>>Stationeries</option>
                        <option value="6" <?PHP if ($product->getProductCategory() == '6') {
            echo 'selected';
        } ?>>Perodicals</option>
                        <option value="7" <?PHP if ($product->getProductCategory() == '7') {
            echo 'selected';
        } ?>>Audibles</option>
                        <option value="8" <?PHP if ($product->getProductCategory() == '8') {
            echo 'selected';
        } ?>>Gift Ideas</option>
                    </select>
                </p>
                <p class="smallInput">In stock<br><input name="PInstock"  value="<?= $product->getInStock() ?>"required></p>
                <p>Price (Inc. GST)<br><input name="PPrice"  value="<?= $product->getPrice() ?>"required></p>
                <p>Sold<br><input name="PSold"  value="<?= $product->getSold() ?>"required></p>
                <br>
                <p><button class="GeneralButton" type="submit">Submit</button>
                    <button class="GeneralButton">Cancel</button></p>
        </form>
        </article>
        <?php
    }

}
?>
