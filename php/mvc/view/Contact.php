<?php
namespace mvc\view;

class Contact extends View {

public function body($contact) {
extract($_POST);


if(isset($contactEmail))
{

$headers = 'From:'.$contactEmail .
"\r\n" .
'Reply-To:' .$contactEmail .
"\r\n" .
'X-Mailer: PHP/' . phpversion();

mail('fotouhifar@gmail.com', $contactSubject, $contactContent, $headers);

}
?>



<article id="fullArticle">
    <!--   CONTENT TITLE          -->

    <div id="pageTitle"><p><?=$this->title?></p></div>


    <form id="ContctForm" action="" method="post">
        <div id="ContactTitleDiv">
            <div>
                Subject<input name="contactSubject" id="ContactTitle" type="text" required>
            </div>
            <div>
                Email<input name="contactEmail" id="ContactTitle" type="text" required>
            </div>
            <div>
                Phone<input name="contactNumber" id="ContactTitle" type="text">
            </div>
            <button type="submit" id="EditDetails">SEND</button>

        </div>

        <div id="ContactTextDiv">
            Content<textarea  name="contactContent" id="ContactContent" required style=""></textarea>



        </div>


    </form>




</article>

<?PHP
}

}
?>





