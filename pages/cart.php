<?php
/* Läser in Template för basinfo, Product för att kunna använda den infon */
require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

$total_sum = array_sum(array_column($products, 'price'));
$is_logged_in = isset($_SESSION["user"]);


Template::header("Varukorg"); ?>


<!-- om du  är inloggad men carten är tom, klicka på länken så kommer du till produkter -->
<?php if (count($products) == 0) : ?>
    <?php if ($is_logged_in) : ?>
    <div class="empty-cart">
        <a class="link-oops" href="/pages/products.php">Ooops... Här var det tomt. Gå till produkter</a>
    </div>
    <?php endif; ?>
<?php endif; ?>

<!-- om du inte är inloggad klickar du på länken så kommer du till produkter -->
<?php if (count($products) == 0) : ?>
    <?php if (!$is_logged_in) : ?>
    <div class="empty-cart">
        <a class="link-oops" href="/pages/products.php">Ooops... Här var det tomt. Gå till produkter</a>
    </div>
    <?php endif; ?>
<?php endif; ?>


<!-- loopar igenom att produkter i korgen -->
<?php foreach ($products as $product) : ?>
    <article class="product">
            <div class="admin-box-right">
                <img src="<?= $product->img_url ?>" height="150" width="150">
                <div class="title-price-cart">
                    <b style="padding-right: 10%"><?= $product->title ?></b>
                    <?= $product->price ?> kr
                </div>
            </div>
        </div>
        </div>
    </article>
<?php endforeach; ?>

<!-- om du är inloggad och har mer än 0 i carten så kommer denna kod upp -->
<?php if (count($products) > 0) : ?>
    <?php if ($is_logged_in) : ?>
        <hr style="margin:.8%; width: 25%">
        <div class="admin-box-right">
            <h3 class="cart-heading"> Total: <?= $total_sum ?>:- </h3>
        </div>

        <!-- Lägg beställningen, klicka på knappen och du skcikas vidare till post-place-order.php -->
    <div class="form-div-row">
        <form action="/../scripts/post-place-order.php" method="post" class="admin-box-rightt">
            <input class="place-orderBtn" type="submit" value="Lägg beställning">
        </form>
                <!-- Lägg beställningen, klicka på knappen och du skcikas vidare till post-delete-cart.php -->
        <form action="/../scripts/post-delete-cart.php" method="post" class="admin-box-rightt">
            <input type="submit" value="Radera varukorg" class="place-orderBtn">
        </form>
    </div>



    <?php else : ?>
        <div class="empty-cart">
            <a class="link-oops" href="/pages/login.php"> Logga in för att lägga beställning </a>
        </div>
    <?php endif; ?>
<?php else : ?>



<?php endif; ?>






<?php

Template::footer();

?>