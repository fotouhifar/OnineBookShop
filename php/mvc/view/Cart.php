<?php

namespace mvc\view;

class Cart extends View {

    protected $editable = true;

    public function body($model) {
        ?>
        <article id="fullArticle">
            <!--   CONTENT TITLE          -->

            <div id="pageTitle"><p>Cart Details</p></div>

            <div id="CartDetails">

                <?PHP
                if (!$this->controller->isCart()) {
                    echo "<h2 id='msg'>cart empty</h2>";
                } else {
                    if ($_SESSION['OBSusertype'] == 'admin') {
                        echo "<h2>Check out is not available for Admin!</h2>";
                    }
                    if ($_SESSION['OBSusertype'] == 'visitor') {
                        echo "<h2>Please sign in or Register to check out</h2>";
                    }
                }
                ?>
                <table id="cartTable">
                    <tr>
                        <th>X</th>
                        <th>Title</th>

                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>

                    </tr>
                    <?php
                    while ($model->nextProduct()) {
                        ?>
                        <tr>
                            <td><br>
                                <?PHP if ($this->editable) { ?>           
                                    <a style="color: red;" href="<?= PROJECT_URL ?>cart/<?= $model->getSpecificationURL() ?>/0">X
                                    <?PHP } ?>
                            </td>

                            <td><img  src='<?= PRODUCTIMAGE . $model->getProductImage(); ?>' >
                                <br><?= $model->getProductTitle() ?>
                                <br>
                                <?PHP
                                if ($model->getAuthor())
                                    echo "by: " . $model->getAuthor();
                                ?>

                            </td>
                            <td><br>
                                <input class="InputNumber" type='number'  min="0" max="<?= $model->getInStock() ?>"
                                       value="<?= $model->getQuantity() ?>"
                                       id="<?= $model->getSpecificationURL() ?>" 
                                       onchange="changeQuantity(this)"
                                       />
                            </td>
                            <td><br>$<?= number_format($model->getPrice(), 2) ?></td>                         
                            <td><br>$<?= $model->getFormattedSubtotal() ?></td>

                        </tr>
                        <?php
                    }
                    ?>

                    <tr id="gstrow">
                        <td style="visibility: hidden"></td>
                        <td style="visibility: hidden"></td>
                        <td style="visibility: hidden"></td>
                        <td>Inc GST</td>       
                        <td>$<?= number_format($model->getFormattedTotal() / 11, 2) ?></td>

                    </tr>
                    <tr  id="lastrow">
                        <td style="visibility: hidden"></td>
                        <td style="visibility: hidden"></td>
                        <td style="visibility: hidden"></td>
                        <td> TOTAL</td>       
                        <td>$<?= $model->getFormattedTotal() ?></td>

                    </tr>
                </table>

                <?PHP
                $displayCheckout = ($this->controller->isCheckout()) ? "inline" : "none";
                $displaySignin = ($this->controller->isSignedIn()) ? "none" : "inline";
                ?>

                <button class="GeneralButton" id="EmptyCart">Empty Cart</button>
                <!--
                <button class="GeneralButton" id="SaveCart">Load Cart</button>
                <button class="GeneralButton" id="SaveCart">Save Cart</button>
                -->
                <a href="<?= PROJECT_URL . 'category' ?>"><button class="GeneralButton" style="width: 200px;">Continue Shopping</button></a>

                <a href="<?= PROJECT_URL ?>checkout"><button
                    <?PHP
                    if ($_SESSION['OBSusertype'] <> 'customer' || !$this->controller->isCart()) {
                        echo "disabled";
                    }
                    ?>
                        class="GeneralButton" id="Checkout">Check Out</button></a>
                <br>
            </div>

        </article>

        <script type="text/javascript">

            function changeQuantity(node)
            {

                quantity = node.value;
                if (quantity ><?= $model->getInStock() ?>)
                    quantity =<?= $model->getInStock() ?>;
                if (quantity < 0)
                    quantity = 1;

                id = node.id;
                location = '<?= PROJECT_URL ?>cart/' + id + '/' + quantity;
            }
        </script>
        <?php
    }

}
?>
