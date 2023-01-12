<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/OrdersDb.php";
require_once __DIR__ . "/../classes/UsersDb.php";
require_once __DIR__ . "/../classes/ProductsDb.php";

//$logged_in_user = $_SESSION["user"];
$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

Template::header("Mina ordrar");


$orders_db = new OrdersDb();
$orders = $orders_db->get_one_by_userid($logged_in_user->id);


$products_db = new ProductsDb();
$all_products = [];
$order_value = 0;


?>

<h2>My orders</h2>

<?php
if (!$is_logged_in) : ?>
    <a href="/pages/register.php"></i>Login/register to place order</a>
<?php endif; ?>


<?php foreach ($orders as $order) : ?>
    <hr><br>
    <p>
        <b><p>USERID: </p></b><?=$order->user_id?>
        <b><p>STATUS: </p></b><?= $order->status ?>
        <b><p>DATE: </p></b><?= $order->order_date?>
    </p>


    <?php $products = $products_db->get_by_order_id($order->id);

    
foreach ($products as $product) {
    $order_value += $product->price;
} ?>

<?php foreach ($products as $product) : ?>
    <?php array_push($all_products, $product); ?>
    <p>
        <img src="<?= $product->img_url ?>" width="50" height="50" alt="Product image">
        <i><?= $product->name ?></i>
        <i><?= $product->price ?>kr</i>
    </p>


<?php endforeach; ?>
<b> Order value: <?= $order_value ?> kr</b>
<?php $order_value = 0; ?>
<hr>

<?php endforeach; ?>

<?php $products = $products_db->get_by_order_id($logged_in_user->id); ?>


<div>
<h2>Total value: <?= $sum = array_reduce($all_products, function ($arr, $value) {
                return $arr + $value->price;
            })  ?> Kr </h2>
</div>


<?php

Template::footer();

echo "Hello World";