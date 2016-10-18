<?php

namespace mvc\view;

class Newpost extends View {

    //put your code here

    public function body($model) {
        ?>

        <article id="fullArticle">
            <!--   CONTENT TITLE          -->
            <div id="pageTitle"><p>Add New Post</p></div>
            <div id="pageContent">
                <form action="Newpost" method="post">

                    <div id="ReportPaper">
                        <textarea id="newposttext" name="postContent">Content of new post</textarea>
                    </div>

                    <p>
                        Post Title<br><input type="text" name="postTitle">
                    </p> 

                    <p>
                        Image<br><input type="text"><button value="browse">Browse</button><button value="UPLOAD">Upload</button>
                    </p>

                    <input type="submit" class="GeneralButton">SUBMIT</input>

                </form>
            </div>



        </article>


        <?PHP
    }

}
?>
