<?php

namespace mvc\view;

class Register extends View {

    //put your code here

    public function body($model) {
        ?>
        <article id="mainArticle">
            <!--   CONTENT TITLE          -->
            <div id="pageTitle"><p>Registration Form</p></div>
            
            
            
            <form id="registrationForm" action="register" method="post" onsubmit="return validateRegForm();">
                <div>
                    <p style="padding-left: 100px; color: #FF8888; font-weight: bold;">* Required *</p>
                    <p>First name<input type="text" name="fn" required></p>
                    <p>Last name<input type="text" name="ln" required></p>
                    <p>Email<input type="email" name="em" required value="asd@asd.com"></p>
                    <p>Password<input type="password" name="pw" required></p>
           <!--         <p>Verify Password<input type="password" required></p>-->


                </div>
                <div>
                    <p style="padding-left: 100px; color: #00cc00; font-weight: bold;">Optional </p>

                    <p> Address<input type="text" name="ad"></p>
                    <p>Suburb<input type="tex" name="sb"></p>
                    <p>State<input type="text" name="st"></p>            

                    <p>Postcode<input type="text" name="pc"></p>
                    <p>Country<input type="text" name="cr"></p>
                    <p> Newsletter<input  class="CheckBox" type="checkbox" name="nl" checked></p>


                </div>
                <div id="SubmitRegDiv">
                    <input  class="CheckBox" id="TermsAgreement" type="checkbox" required>
                    I agree to terms and conditions
                    <input id="FormSubmit" class="GeneralButton" type="SUBMIT"  value="SUBMIT">

                </div>

            </form>

        </article>
        <!--  END OF ARTICLE   -->

        <!-- START ASIDE -->


        <?PHP
        require_once (INCLUDES . 'sidebar.php');
    }

}
?>
