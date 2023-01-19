<?php

require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/Template.php";

$products = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

$total_sum = array_sum(array_column($products, 'price'));
$is_logged_in = isset($_SESSION["user"]);


Template::header("Varukorg"); ?>



<?php if (count($products) == 0) : ?>
    <?php if ($is_logged_in) : ?>
    <div class="empty-cart">
        <a class="link-oops" href="/pages/products.php">Ooops... Här var det tomt. Gå till produkter</a>
    </div>
    <?php endif; ?>
<?php endif; ?>

<?php if (count($products) == 0) : ?>
    <?php if (!$is_logged_in) : ?>
    <div class="empty-cart">
        <a class="link-oops" href="/pages/products.php">Ooops... Här var det tomt. Gå till produkter</a>
    </div>
    <?php endif; ?>
<?php endif; ?>



<?php foreach ($products as $product) : ?>
    <article class="product">
            <div class="admin-box-right">
                <img src="<?= $product->img_url ?>" height="75" width="75">
                <div class="title-price-cart">
                    <b><?= $product->title ?></b>
                    <?= $product->price ?> kr
                </div>
            </div>
        </div>
        </div>
    </article>



<?php endforeach; ?>
<?php if (count($products) > 0) : ?>
    <?php if ($is_logged_in) : ?>

        <form action="/../scripts/post-place-order.php" method="post" class="form-div">
            <div class="admin-box-right">
                <h3 class="admin-heading"> Total: <?= $total_sum ?>:- </h3>
            </div>
            <div class="admin-box-right">
                <input class="place-orderBtn" type="submit" value="Lägg beställning">
            </div>
        </form>
        <form action="/../scripts/post-delete-cart.php" method="post">
            <input type="submit" value="Radera varukorg" class="produkt-btn">
        </form>

    <?php else : ?>
        <a href="/pages/login.php"> Login to place order </a>
    <?php endif; ?>
<?php else : ?>



<?php endif; ?>



<?php if (count($products) < 0) : ?>
    <a href="/pages/products.php"> Cart is empty</a>
<?php endif; ?>


<?php

Template::footer();

?>