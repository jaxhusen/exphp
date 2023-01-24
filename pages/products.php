<?php
/* Läser in Template för basinfo, Product + ProductDb för att kunna använda den infon */
require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/ProductsDb.php";
require_once __DIR__ . "/../classes/Template.php";

/* läser in alla produkter via Product */
$products_db = new ProductsDb();
$products = $products_db->get_all();

Template::header("Products");
?>

<!-- loopar genom alla produkter med zoom effect,
ett form för när du klickar på ADD TO CART så skickas du till post-add-to-cart.php -->
<div class="grid-container"> 
<?php foreach ($products as $product) : ?>
    <div class="grid-card">
        <h2><?= $product->title ?></h2>
        <h4 class="h4-pad"><i><?= $product->price ?> :-</i></h4>
        <div class="zoom-img-container">
            <img src="<?= $product->img_url ?>" alt="Product image" class="img zoom-img">
        </div>
        <form action="/scripts/post-add-to-cart.php" method="post">
            <input type="hidden" name="product-id" value="<?= $product->id ?>">
            <input class="box-btn" type="submit" value="Lägg till i varukorg">
        </form>
    </div>

<?php
endforeach; ?>
</div>
<?php
Template::footer();?>