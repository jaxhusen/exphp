<?php
/* Läser in Template för basinfo, ProductsDb för att kunna använda den infon */
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDb.php";

/* sparas i session om användare är inloggad, admin/kund har oliak sidor som visas */
$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

//om dom inte är admin
if (!$is_admin) {
    http_response_code(401); // access denied
    die("Access denied");
}

if (!isset($_GET["id"])) {
    die("Invalid input");
}

/* kallar på koden för att hämta en product eftersom att denna sida är på en single-product */
$products_db = new ProductsDb();
$product = $products_db->get_one($_GET["id"]);


Template::header("Update product");



if ($product == null) : ?>
    <h2 class="admin-heading">Inga produkter</h2>

<?php else : ?>
    <!-- form för att kunna uppdatera namn, bild, pris eller radera produckten via ID -->
    <h2 class="admin-heading">Uppdatera:</h2>
    <div class="form-container">
    <form action="/scripts/post-update-product.php?id=<?= $_GET["id"] ?>" method="post" enctype="multipart/form-data" class="form-login">
        <input class="form-input" type="text" name="title" placeholder="Name" value="<?= $product->title ?>"> <br>
        <input class="form-input" type="number" name="price" placeholder="Price" value="<?= $product->price ?>"> <br>
        <img src="<?= $product->img_url ?>" width="100%" style="margin-bottom:2%; border: 1px solid rgba(131, 131, 131, 0.768)"><img></br>
        <input class="form-input" type="file" name="img_url" accept="image/*"> <br>
        <input class="user-regitration" type="submit" value="Spara">
    </form>
    <form action="/scripts/post-delete-product.php" method="post" class="form-login" style="margin-top: -2%">
            <input type="hidden" name="id" value="<?= $_GET["id"] ?>">
            <input class="user-regitration" style="margin-top:2%" type="submit" value="Radera produkt">
    </form>
</div>

<?php
endif;

Template::footer();