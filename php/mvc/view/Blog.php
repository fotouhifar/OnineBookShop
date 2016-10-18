<?php

namespace mvc\view;

class Blog extends View {

    public function body($post) {


        extract($_POST);
        if (!isset($PageNumber)) {
            $PageNumber = 1;
        }
        if (!isset($NoItems)) {
            $NoItems = 5;
//            echo $NoItems;
        }
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
        ?>
        <article id="mainArticle">
            <!--   CONTENT TITLE          -->

            <div id="pageTitle"><p>Blog</p></div>
            <div id="CustomiseSearch">
                <form action="" method="post">

                    <button id="RefineSearch" type="submit">Refine List</button>
                    <div>
                        <select name="NoItems" class="DropDownBox">
                            <option value=2 <?PHP
                            if ($NoItems == 2) {
                                echo "selected";
                            }
                            ?>>2 Post per Page</option>
                            <option value=5 <?PHP
                            if ($NoItems == 5) {
                                echo "selected";
                            }
                            ?>>5 Post per Page</option>
                            <option value=10 <?PHP
                            if ($NoItems == 10) {
                                echo "selected";
                            }
                            ?>>10 Post per Page</option>
                        </select> 
                    </div>


                </form>
            </div>

            <?PHP
            $counter = ($PageNumber - 1) * $NoItems + 1;

            for ($i = 0; $i < ($PageNumber - 1) * $NoItems; $i++) {
                $post->next();
            }


            while ($post->next() && $counter <= ($PageNumber * $NoItems)) {
                ?> 
                <div id="PostDiv">
                    <div id="PostComments"><a href="">(27) Comments</a></div>
                    <div id="PostTitle"><h3><?= $post->getPostTitle() ?></h3></div>
                    <div id="PostContent"><?= $post->getPostContent() ?></div>
                    <div id="PostSocial">
                        <img src="<?= IMAGES_URL ?>facebook_001.jpg">
                        <img src="<?= IMAGES_URL ?>Twitter_001.jpg">
                        <img src="<?= IMAGES_URL ?>Google_Plus_001.jpg">
                        <img src="<?= IMAGES_URL ?>email_001.jpg">
                    </div>
                    <div id="PostSeparator"></div>

                </div>
                <?PHP
                $counter++;
            }
            ?>
        </div>

        <!--          Product categories list       -->      

        <br>
        <p>
        <form id="TurnPage" method="post">
            <button 
            <?PHP
            if ($PageNumber == 1)
                echo 'disabled';
            ?>
                class="GeneralButton" type="submit" id="PreviousePage" style="float: left;" name="TurnPage" value="Pre">< < < PREVIOUS</button>


            <button
            <?PHP
            if ($PageNumber * $NoItems >= $post->getRowCount())
                echo 'disabled';
            ?>
                class="GeneralButton" type="submit"  id="NextPage" style="float: right;" name="TurnPage" value="Next">NEXT > > ></button>
            <input name="NoItems" value="<?= $NoItems ?>" style="visibility: hidden">
            <input name="PageNumber" value="<?= $PageNumber ?>" style="visibility: hidden">
        </form>
        </p>
        </article>

        <?php
        require_once (INCLUDES . 'sidebar.php');
    }

}
?>
