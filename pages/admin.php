<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDb.php";
require_once __DIR__ . "/../classes/UsersDb.php";
require_once __DIR__ . "/../classes/OrdersDb.php";

//kontrollera att användaren är inloggad som admin
$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";


if (!$is_admin) { //om dom inte är admin
    http_response_code(401); // access denied
    die("Access denied!!");
}


$users_db = new UsersDb();
$users = $users_db->get_all();


$products_db = new ProductsDb();
$products = $products_db->get_all();


$orders_db = new OrdersDb();
$orders = $orders_db->get_all();


Template::header("Admin sida"); ?>


 <h2 class="admin-heading"> Skapa produkt </h2>
 <div class="form-container">
<form class="form-login" action="/admin-scripts/post-create-product.php" method="post" enctype="multipart/form-data">
    <input class="form-input" type="text" name="title" placeholder="Titel"> <br>
    <input class="form-input" type="number" name="price" placeholder="Pris"><br>
    <input class="form-input" type="file" name="image" accept="image/*"><br>
    <div class="form-btns">
        <input class="user-regitration" type="submit" value="Spara">
    </div>
</form> 
</div>
<hr>

<h2 class="admin-heading"> Produkter </h2>
<div class="admin-users">
        <div class="admin-users-box">
<?php foreach ($products as $product) : ?>
    <div class="admin-user-card">
        <a class="users-name" href="/pages/admin-product.php?id=<?= $product->id ?>">
            <?= $product->title ?></a> 
            <i class="users-role"> - <?= $product->price ?> SEK</i></br>
        </div>
<?php endforeach; ?>
</div>
</div>

<hr>


<h2 class="admin-heading"> Användare </h2>
<div class="admin-users">
        <div class="admin-users-box">
<?php foreach ($users as $user) : ?>
<div class="admin-user-card">
            <a class="users-name" href="/pages/admin-user.php?username=<?= $user->id ?>"><?= $user->username ?></a>
        <i class="users-role">- <?= $user->role ?></i></br>
        </div>
<?php endforeach; ?>
</div>
</div>


<hr>
<h2 class="admin-heading">Alla ordrar</h2>
<div class="admin-orders-master">
<?php foreach ($orders as $order) : ?>

    <div class="admin-orders-container">
        <div class="admin-box">
            <div class="admin-box-left">
                <p>STATUS: </p> <?= $order->status ?>
            </div>
            <div class="admin-box-right">
                <p>DATUM: </p> <?= $order->order_date ?>
            </div>
        </div>

        <div class="admin-box">
            <div class="admin-box-left">
                <form action="/admin-scripts/post-update-order.php" method="post">
                    <select name="Status">
                        <option disabled selected>Status</option>
                        <option value="waiting"> Väntande ..</option>
                        <option value="sent"> Skickad</option>
                    </select>
                    <input type="submit" value="Spara">
                </form>
            </div>
            <div class="admin-box-right">
                <form action="/admin-scripts/post-delete-order.php" method="post">
                    <input type="hidden" name="id" value="<?= $order->id ?>">
                    <input type="submit" value="Radera order">
                </form>
            </div>
        </div>
    </div>


<?php endforeach; ?>
</div>

<?php

Template::footer();

?>