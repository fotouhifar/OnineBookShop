<?php

namespace mvc\view;

class Newestproducts extends Partview {

    public function body($product) {
        ?>
<aside>

</p></div>


<!-- LAST PRODUCTS -->
<div id="LastProductsTitle"><p>Newest Products</p></div>

<div class="smallProduct">
    <a href="">
        <div class="smallItemImage"><img alt="Image alt comes here" src="<?= PRODUCTIMAGE ?>books/10012.jpg"></div>
        <div class="smallItemDesc">Description</div>
    </a>
</div>



<!-- MOST SELLING PRODUCTS -->
<div id="MostSellingProductsTitle"><p>Most Selling Products</p></div>

<div class="smallProduct">
    <a href="">
        <div class="smallItemImage"><img alt="Image alt comes here" src="<?= PRODUCTIMAGE ?>periodicals/time-2014-02-24.jpg"></div>
        <div class="smallItemDesc">Description</div>
    </a>
</div>





<div id="subscription">
    <form id="SubForm" action="<?= PROJECT_URL ?>subscribe" method="post" onsubmit="return validateSubForm();">

        <input type="email" value="Your@email.com" name="em">
        <button class="GeneralButton" type="submit">Subscribe/ Unsubscribe</button>
    </form>
</div>


</aside>




        <?php

    }

}
?>
