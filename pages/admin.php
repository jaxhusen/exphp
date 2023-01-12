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


Template::header("Admin area"); ?>


 <h2> Create product </h2>
<form action="/admin-scripts/post-create-product.php" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title"> <br>
    <input type="number" name="price" placeholder="Price">
    <input type="file" name="image" accept="image/*"><br>
    <input type="submit" value="Save">
</form> 

<hr>

<h2> Products </h2>
<?php foreach ($products as $product) : ?>
    <p>
        <a href="/pages/admin-product.php?id=<?= $product->id ?>">
            <?= $product->title ?>
        </a>
    </p>
<?php endforeach; ?>
<hr>


<h2> Users </h2>
<?php foreach ($users as $user) : ?>
    <p>
        <a href="/pages/admin-user.php?username=<?= $user->id ?>"><?= $user->username ?></a>
        <i><?= $user->role ?></i>
    </p>
<?php endforeach; ?>



<hr>
<h2>All orders</h2>
<?php foreach ($orders as $order) : ?>
    <p>
    <p>STATUS: </p> <?= $order->status ?>
        <br><p>DATE: </p> <?= $order->order_date ?>


    <form action="/admin-scripts/post-update-order.php" method="post">
        <select name="Status">
            <option disabled selected>Status</option>
            <option value="waiting">Waiting</option>
            <option value="sent">Sent</option>
        </select><br>
        <input type="submit" value="Save">
    </form>


    <form action="/admin-scripts/post-delete-order.php" method="post">
        <input type="hidden" name="id" value="<?= $order->id ?>">
        <input type="submit" value="Delete order"><br><hr>
    </form>
<?php endforeach; ?>


<?php

Template::footer();

?>