<?php

namespace mvc\view;

class Customers extends View {

    public function body($customer) {

        extract($_POST);

        if (!isset($PageNumber)) {
            $PageNumber = 1;
        }

        $NoItems = 10;

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
        // echo $PageNumber . '<br>';
        //  echo "TurnPage" . $TurnPage . "<br>";
        //    echo $NoItems . "<br>";
        ?>


        <article id="fullArticle">
            <!--   CONTENT TITLE          -->

            <div id="pageTitle"><p><?= $this->title ?></p></div>
            <div id="fullArticleContent">




                <table id="customerListTable">
                    <tr>
                        <th>EDIT</th>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Street address</th>
                        <th>Suburb</th>
                        <th>State</th>
                        <th>Postcode</th>
                        <th>Country</th>
                        <th>Type</th>
                    </tr>

                    <?PHP
                    $counter = ($PageNumber - 1) * $NoItems + 1;
                    for ($i = 0; $i < ($PageNumber - 1) * $NoItems; $i++) {
                        $customer->next();
                    }

                    while ($customer->next() && $counter <= ($PageNumber * $NoItems)) {
                        ?>

                        <tr id="<?= $customer->getCId() ?>">
                            <td>
                                <button id="editcustomerListTable" class="editCustomerLink" onclick="editCustomer(<?= $customer->getCId() ?>)">Edit</button>
                            </td>
                            <td><?= $id = $customer->getCId() ?></td>
                            <td><?= $customer->getCFirstname() ?></td>
                            <td><?= $customer->getCLastname() ?></td>
                            <td><?= $customer->getCAddress() ?></td>
                            <td><?= $customer->getCSuburb() ?></td>
                            <td><?= $customer->getCState() ?></td>
                            <td><?= $customer->getCPostcode() ?></td>
                            <td><?= $customer->getCCountry() ?></td>
                            <td><?= $customer->getCType() ?></td>
                        </tr>
                        <tr id="edit<?= $customer->getCId() ?>" class="editCustomerTR">

                        <form action="<?= PROJECT_URL ?>editcustomer" method="post">    
                            <td>

                                <button id="submitcustomerListTable" name="editquery" value="edit" class="editCustomerLink"  onclick="submitEditCustomer(<?= $customer->getCId() ?>)">Submit</button><br>
                                <div id="cancelcustomerListTable" name="editquery" value="cancel" class="editCustomerLink"   onclick="submitEditCustomer(<?= $customer->getCId() ?>)">Cancel</div>
                                <button id="deletecustomerListTable" name="editquery" value="delete" class="editCustomerLink"   onclick="submitEditCustomer(<?= $customer->getCId() ?>)">Delete</button><br>


                            </td>
                            <td><?= $customer->getCId() ?></td>
                            <input name="id" value="<?= $customer->getCId() ?>" style="visibility: hidden;">
                            <td><input name="fn" value="<?= $customer->getCFirstname() ?>"></td>
                            <td><input name="ln"  value="<?= $customer->getCLastname() ?>"></td>
                            <td><input name="ad"  value="<?= $customer->getCAddress() ?>"></td>
                            <td><input name="sb"  value="<?= $customer->getCSuburb() ?>"></td>
                            <td><input name="st"  value="<?= $customer->getCState() ?>"></td>
                            <td><input name="pc"  value="<?= $customer->getCPostcode() ?>"></td>
                            <td><input name="cr"  value="<?= $customer->getCCountry() ?>"></td>

                            <td>

                                <select name="type" value="<?= $customer->getCType() ?>">
                                    <option value="customer"
                                    <?php
                                    if ($customer->getCType() == 'customer') {
                                        echo "selected";
                                    }
                                    ?>
                                            >customer</option>

                                    <option value="admin"
                                    <?php
                                    if ($customer->getCType() == 'admin') {
                                        echo "selected";
                                    }
                                    ?>


                                            >admin</option>

                                </select>
                            </td>
                            
                        </form>


                        </tr>
                        <?PHP
                        $counter++;
                    }
                    ?>
                </table>
            </div>


            <p>
            <form id="TurnPage" method="post">
                <button 
                <?PHP
                if ($PageNumber == 1)
                    echo 'disabled';
                ?>
                    class="GeneralButton" type="submit" id="PreviousePage" style="float: left;" name="TurnPage" value="Pre">< < < PREVIOUS</button>
                <input name="NoItems" value="<?= $NoItems ?>" style="visibility: hidden">
                <input name="PageNumber" value="<?= $PageNumber ?>" style="visibility: hidden">

                <button
                <?PHP
                if ($PageNumber * $NoItems >= $customer->getRowCount())
                    echo 'disabled';
                ?>
                    class="GeneralButton" type="submit"  id="NextPage" style="float: right;" name="TurnPage" value="Next">NEXT > > ></button>
                <input name="NoItems" value="<?= $NoItems ?>" style="visibility: hidden">
                <input name="PageNumber" value="<?= $PageNumber ?>" style="visibility: hidden">
            </form>

        </p>
        <!--
            <div id="editCustomersDiv">
            </div>
        -->
        <?php
    }

}
?>
