<?php

namespace mvc\view;

class Newsletter extends View {

    //put your code here

    public function body($cEmail) {
        extract($_POST);

        $headers = 'From: newsletter@obs.amirfar.com' .
                "\r\n" .
                'Reply-To: newsletter@obs.amirfar.com.com' .
                "\r\n" .
                'X-Mailer: PHP/' . phpversion();
        ?>
        <article id="fullArticle">
            <!--   CONTENT TITLE          -->
            <div id="pageTitle"><p>Send Newsletter</p></div>
            <div id="CartDetails">
                <?PHP
                if (!$cEmail) {
                    ?>     
                    <form id="NewsletterForm" action="<?= PROJECT_URL ?>newsletter" method="post">
                        <p>
                            Subject<br><input id="NewsletterSubject" name="nlSubject" type="text">
                        </p> 
                        <p id="NewsletterContent">
                            Newsletter Content<br><textarea name="nlMessage"></textarea>
                        </p>
                        <p>
                            Attachment <input name="nlFile" type="file">
                        </p>
                        <button class="GeneralButton" type="submit">SEND</button>
                    </form>
                    <?PHP
                }
                if ($cEmail) {
                    echo "<p class='ReportPar'><h3>Newsletter Send Report</h3></p>"
                    . "<p class='ReportPar'><h4>Message Subject : <br> </h4>$nlSubject</p>"
                    . "<p class='ReportPar'><h4>Message Content : <br></h4>$nlMessage</p>"
                    . "<p class='ReportPar'><h4>Message Content : <br></h4>$nlFile</p>"
                    . "<p id='newsletterReport'><textarea>";
                    if (isset($nlFile))
                    {
                        copy($nlFile,$nlFile.'2');
                    }
                        while ($cEmail->next()) {

                        if (mail($cEmail->getEmail(), $nlSubject, $nlMessage, $headers))
                        {
                            echo "Message Sent To: ".
                            $cEmail->getEmail()
                            . "\r\n";
                        }
                    }
                    echo "</textarea></p>";
                }
                ?>
            </div>
        </article>
        <?PHP
    }

}
?>
