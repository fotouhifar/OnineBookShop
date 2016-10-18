<?php

namespace mvc\view;

class Checkout extends Cart {

    public function body($cart) {
        ?>
        <article id="fullArticle">
            <!--   CONTENT TITLE          -->

            <div id="pageTitle"><p>Check Out</p></div>

            <div id="CheckoutPageContent">
                <!--
                                <p><h2>Thank you to purchase from Online Book Shop</h2>
                                </p>
                -->
                <select id="SelectPayment">
                    <option>Select payment method ...</option>
                    <option>Master Card</option>
                    <option>Visa</option>
                    <option>PayPal</option>
                </select>
                <br>

                <div id="PayPalDetails">
                    <img src="<?= IMAGES_URL ?>mastercard.png">
                    <br>

                    Name on card<br><input ><br>
                    Card Number<br><input ><br>
                    CVV<br><input ><br>
                    Expiry date<br>
                    <select>
                        <?PHP
                        for ($i = 1; $i <= 12; $i++) {
                            echo "<option>$i</option>";
                        }
                        ?>
                    </select>

                    <select>
                        <?PHP
                        $currentYear = (int) date("Y");
                        for ($i = $currentYear; $i < $currentYear + 15; $i++) {
                            echo "<option>$i</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <button class="GeneralButton" id="SubmitCard">SUBMIT</button>
                </div>
            </div>
        </article>
        <?php
    }

}
?>

