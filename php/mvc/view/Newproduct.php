<?php

namespace mvc\view;

class Newproduct extends View {

    public function body($product) {
        ?>


        <div id="pageTitle"><p>New Product</p></div>
        <form id="editProductForm" onsubmit="validateProductForm()" action="<?= PROJECT_URL ?>newproduct" method="post">


            <article id="fullArticleContent">

                <p>Title <br><input name="PTitle" required></p>
                <p>Book Author (If applicable)  <br><input name="PAuthor" ></p>

                <p>Item description<br><textarea name="PDescription"></textarea></p>



                <p>Periodical Date (If applicable) <br> <input name="PDate"  type="date"></p>
                <p>Image <br> <input name="PImage" ></p>
                <p>Category<br>
                    <select name="PCategory" required>
                        <option value="1" >E-book readers</option>
                        <option value="2" >Books</option>
                        <option value="3" >E-books</option>
                        <option value="4" >Reader accessories</option>
                        <option value="5" >Stationeries</option>
                        <option value="6" >Perodicals</option>
                        <option value="7" >Audibles</option>
                        <option value="8" >Gift Ideas</option>
                    </select>
                </p>
                <p class="smallInput">In stock<br><input name="PInstock"  required></p>
                <p>Price (Inc. GST)<br><input name="PPrice"  required></p>
                <p>Sold<br><input name="PSold"   required></p>
                <br>
                <p><button class="GeneralButton" type="submit">Submit</button>
                    <button class="GeneralButton">Cancel</button></p>
        </form>
        </article>
        <?php
    }

}
?>
