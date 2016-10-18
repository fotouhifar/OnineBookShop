<?php

namespace mvc\view;

class About extends View {

    public function body($category) {


        ?>

        <article id="fullArticle">
            <!--   CONTENT TITLE          -->

            <div id="pageTitle"><p>About<br> Online Book Shop Project</p></div>
            <div id="pageTitle"><p>GENERAL DESCRIPTION</p></div>
            <div class="AboutContent">


                Online Book Shop project will be online business to demonstrate books and reading products such as e-book readers and accessories to sell online. Customers must be able to brows products by categories and buy them with online shopping methods. After a successful shopping and payment products are dispatched by Australia post for customer.
                <br>
                <img src="<?= IMAGES_URL ?>About/OnlineBookShop_Sitemap.gif">
                <br>

                In this website some web pages are accessible publicly, or just by customers and some pages are for administrator(s).
                <br>
            </div>
            <!--
            <div id="pageTitle"><p>About HTML and CSS Design</p></div>

            <div class="AboutContent">

            </div>
            <div id="pageTitle"><p>About PHP and MySQL code</p></div>

            <div class="AboutContent">

            </div>
            -->
        </article>

        <?PHP
    }

}
?>
