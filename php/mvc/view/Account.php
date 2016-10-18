<?php

namespace mvc\view;

class Account extends View {

    public function body($customer) {
        ?>
        <article id="fullArticle">
            <!--   CONTENT TITLE          -->
            <div id="pageTitle"><p><?= $this->model->customerName ?> Account</p></div>

            <div id="CustomerDetails">
                <div>
                    <?= $this->model->customerName ?> and <?= $this->model->customerLName ?><br>
                    <?= $_SESSION['OBSemail'] ?><br>
                    <?= $this->model->customerAddress ?>, <?= $this->model->customerSuburb ?> <?= $this->model->customerState ?>, <?= $this->model->customerPostcode ?><br>
                    <?= $this->model->customerCountry ?><br>
                </div>

                <!--
                                <a href="editaccount.php"><button id="EditDetails">EDIT</button></a>
                -->
            </div>

            <div id="CustomerProducts">

                <h4>Product History for Customer ID # <?= $customer->customerId ?></h4>

                <table>
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Qty</th>
                        <th>Price</th>

                    </tr>
                    <?PHP
                    while ($customer->next()) {
                        ?>

                        <tr>
                            <td><?= $customer->getOrderDate() ?></td>
                            <td>
                                <a href="<?= PROJECT_URL . 'productspec' . '/' . $customer->getSpecificationURL() ?>">
                                    <?= $customer->getProductTitle() ?>
                                </a>
                            </td>
                            <td><?= $customer->getCategoryURL() ?></td>
                            <td><?= $customer->getQuantity() ?></td>
                            <td><?= $customer->getPrice() ?></td>
                        </tr>
                        <?PHP
                    }
                    ?>

                </table>
            </div>
        </article>
        <?PHP
    }

//put your code here
}
?>