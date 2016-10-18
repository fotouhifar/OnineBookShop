<?php

namespace mvc\view;

class Dashboard extends View {

    public function body($admin) {
        ?>
        <article id="fullArticle">
            <!--   CONTENT TITLE          -->

            <div id="pageTitle"><p>Admin Dashboard</p></div>

            <div id="AdminDashboard">
                <a href="<?= PROJECT_URL ?>report"><div style="background-image:url('<?=IMAGES_URL?>admin/report.png')" ><br>Make a Report</div></a>
                <a href="<?= PROJECT_URL ?>customers"><div style="background-image:url('<?=IMAGES_URL?>admin/customers.png')" ><br>Customer List</div></a>
               <!--
                <a href="editproducts.php">  <div style="background-image:url('< ?=IMAGES_URL?>admin/editproducts.png')" ><br>Edit Products</div></a>
                -->
                
                <a href="<?= PROJECT_URL ?>newproduct">   <div style="background-image:url('<?=IMAGES_URL?>admin/newproducts.png')" ><br>New Products</div></a>
<!--
                <a href="editposts.php">  <div style="background-image:url('< ?=IMAGES_URL?>admin/editposts.png')" ><br>Edit Posts</div></a>
       -->         
                <a href="<?= PROJECT_URL ?>newpost">         <div style="background-image:url('<?=IMAGES_URL?>admin/newposts.png')" ><br>New Posts</div></a>
                <a href="<?= PROJECT_URL ?>newsletter">     <div style="background-image:url('<?=IMAGES_URL?>admin/newsletter.png')" ><br>Send Newsletter</div></a>
            </div>

        </article>
        <?PHP
    }

//put your code here
}
?>