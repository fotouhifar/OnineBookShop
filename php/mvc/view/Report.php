<?php

namespace mvc\view;

class Report extends View {

    private $columnCount = 0;
    private $row;
    private $reportTitle = '';
    private $totalPrice = 0;
    private $totalItems = 0;
    private $sumList = array();

    public function body($report) {
        ?>
        <article id="fullArticle">
            <!--   CONTENT TITLE          -->
            <?PHP
            extract($_POST);
            if (!isset($reportQuery))
                $reportQuery = 0;

            switch ($reportQuery) {
                case 1:
                    $this->reportTitle = "Quantity of products ordered by highest";
                    break;
                case 2:
                    $this->reportTitle = "Quantity of products ordered by lowest";
                    break;
                case 3:
                    $this->reportTitle = "Customers to a state";
                    break;
                case 4:
                    $this->reportTitle = "Total amount spent by customers";
                    break;
                case 5:
                    $this->reportTitle = "Monthly sales";
                    break;
                case 6:
                    $this->reportTitle = "Products in shopping cart not paid for";
                    break;
                case 7:
                    $this->reportTitle = "Quantity and price of category by highest price";
                    break;
                case 8:
                    $this->reportTitle = "Order by name(price,category and quantity)";
                    break;
            }
            //   echo $reportQuery;
            ?>



            <div id="pageTitle"><p>Make a Report</p></div>
            <div id="pageContent">




                <form id="reportForm" action="report" method="post">

                    <div id="ReportPaper">
                        <!-- 
                            OUTPUT OF REPORT
                        -->
                        <?PHP
                        if (isset($reportQuery) && $reportQuery > 0) {
                            echo "<p><h3><i>" . $this->reportTitle . "</i></h3></p>";
                            echo "<p><h5>Date And Time: " . date("l jS \of F Y h:i:s A") . "</h5></p>";
                            echo "<p><h5>Number Of Items: " . $report->getRowCount() . "</h5></p>";
                            ?>
                            <table id="reportTable">
                                <tr>
                                    <?PHP
                                    for ($key = 0; $key < $report->colCount; $key++) {
                                        echo "<th>" . $report->colTitle["$key"] . "</th>";
                                        $this->sumList[$key] = 0;
                                    }
                                    ?>
                                </tr>
                                <?PHP
                                // NUMBER OF COLUMNS
                                //echo $report->colCount;
                                $i = 0;
                                while ($report->next()) {
                                    echo "<tr>";
                                    for ($key = 0; $key < $report->colCount; $key++) {
                                        $thisItem = $report->getDataCell($report->colActualTitle[$key]);
                                        //                    echo $report[$key];
                                        //             var_dump($report);
                                        echo "<td>" . $thisItem . "</td>";
                                        if ($report->numeric[$key])
                                            $this->sumList[$key] += $thisItem;
                                    }
                                    echo "</tr>";
                                }
                                ?>



                                <tr>
                                    <?PHP
                                    for ($key = 0; $key < $report->colCount; $key++) {
                                        echo "<th>";
                                        if ($report->numeric[$key])
                                            echo $this->sumList[$key];
                                        echo "</th>";
                                    }
                                    ?>
                                </tr>


                            </table>    

                            <?PHP
                        } else {
                            echo "REPORT IS NOT SELECTED";
                        }
                        ?>

                    </div>

                    <select name="reportQuery" id="reportNumber">
                        <option value="0" <?PHP if ($reportQuery == 0) echo "selected"; ?>>SELECT A REPORT. . . </option>
                        <option value="1" <?PHP if ($reportQuery == 1) echo "selected"; ?>>1. Quantity of products ordered by highest</option>
                        <option value="2" <?PHP if ($reportQuery == 2) echo "selected"; ?>>2. Quantity of products ordered by lowest</option>
                        <option value="3" <?PHP if ($reportQuery == 3) echo "selected"; ?>>3. Customers to a state</option>
                        <option value="4" <?PHP if ($reportQuery == 4) echo "selected"; ?>>4. Total amount spent by customers</option>
                        <option value="5" <?PHP if ($reportQuery == 5) echo "selected"; ?>>5. Monthly sales</option>
                        <option disabled value="6" <?PHP if ($reportQuery == 6) echo "selected"; ?>>6. Products in shopping cart not paid for</option>
                        <option value="7" <?PHP if ($reportQuery == 7) echo "selected"; ?>>7. Quantity and price of category by highest price</option>
                        <option value="8" <?PHP if ($reportQuery == 8) echo "selected"; ?>>8. Order by name(price,category and quantity)</option>

                    </select>
                    <!--
                                        <p class="reportMonth">
                                            <select id="monthInput" name="monthInput">
                                                <option value="1">January</option>
                                                <option value="2">February</option>
                                                <option value="3">March</option>
                                                <option value="4">April</option>
                                                <option value="5">May</option>
                                                <option value="6">June</option>
                                                <option value="7">July</option>
                                                <option value="8">August</option>
                                                <option value="9">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </p>
                                        <p class="reportMonth">
                                            <select id="yearInput" name="yearInput">
                                                <option value="2014">2014</option>
                                                <option value="2013">2013</option>
                                                <option value="2012">2012</option>
                                                <option value="2011">2011</option>
                                                <option value="2010">2010</option>
                                                <option value="2009">2009</option>
                                                <option value="2008">2008</option>
                    
                                            </select>
                    
                                        </p>
                    
                                        <p hidden="">
                                            From<br><input type="date">
                                        </p>
                                        <p hidden="">
                                            To<br><input type="date">
                                        </p>
                    
                    -->

                    <button class="GeneralButton" type="submit">SUBMIT</button>
                    <br>
                    <button class="GeneralButton" disabled>PDF</button>
                    <br>

                    <button class="GeneralButton" disabled>PRINT</button>
                </form>

            </div>
        </article>

        <?PHP
    }

}

/*
  $content = "
  <page>
  <h1>Exemple d'utilisation</h1>
  <br>
  Ceci est un <b>exemple d'utilisation</b>
  de <a href='http://html2pdf.fr/'>HTML2PDF</a>.<br>
  </page>";

  //require_once('../../html2pdf_v4.03/html2pdf.class.php');
  $html2pdf = new HTML2PDF('P','A4','fr');
  $html2pdf->WriteHTML($content);
  $html2pdf->Output('exemple.pdf');
 */
?>

