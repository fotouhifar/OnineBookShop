<?php

namespace mvc\view;

class Categories extends View {

    public function body($category) {
        ?>
        <article id="mainArticle">
            <!--   CONTENT TITLE          -->

            <div id="pageTitle"><p><?= $this->title ?></p></div>

            <!--          Product categories list       -->      
            <?php
            while ($category->next()) {
                ?>
                <div class="LargeCategory">
                    <a href="<?= PROJECT_URL ?>products/<?= $category->getURL() ?>">
                        <div class="ItemImage"><img alt="Image alt comes here" src="<?= CATEGORIESIMAGES . $category->getImage() ?>"></div>
                        <div class="ItemDesc"><b><?= $category->getTitle() ?></b><br><?= $category->getDesc() ?></div>
                    </a>
                </div>
                <?php
            }
            ?>
        </article>
        <aside>
            <?PHP
            //        require_once ("Newestproducts.php");
            //    require_once ("../controller/Newestproducts.php");
            ?>

        </aside>

        <?PHP
        require_once (INCLUDES . 'sidebar.php');
    }

}
?>
