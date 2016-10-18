<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mvc\view;

/**
 * Description of ExecutePayment
 *
 * @author Paul
 */
class ExecutePayment extends View{
    
    public function body($model) {
                  
        $result = $this->controller->getPayment();
        $payer = $this->controller->getPayer();
        ?>
<h3 style='test-align:center'>Thank You for your purchase</h3>
            <fieldset id='ccPanel' style="width:550px;margin:30px auto">
                <legend>receipt numbers</legend>

                <div border="1px" style="width:80%;margin:20px auto;">  
                         <div class='row'><div class='label'>camping store receipt  : <?= $this->controller->getPurchaseId()->getId() ?>
                        </div>
                         <div class='label'>PayPal receipt number  : <?= $this->controller->getPayment()->getId() ?>
                        </div>
                         </div>
                </div>
            </fieldset>
        <div style='text-align:center;width:30em;height:30px;margin:40px auto'>
            <a href='<?= PROJECT_URL . 'category' ?>'><button class="cart-button" type='button' >home</button></a>
        </div>
  <?php
    }

//put your code here
}
