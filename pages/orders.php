<?php
/* Läser in Template för basinfo, ProductsDb + usersDb + OrdersDb för att kunna använda den infon */
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/OrdersDb.php";
require_once __DIR__ . "/../classes/UsersDb.php";
require_once __DIR__ . "/../classes/ProductsDb.php";

$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

Template::header("");

/* funktion för att hämta varje order på mitt user ID */
$orders_db = new OrdersDb();
$orders = $orders_db->get_one_by_userid($logged_in_user->id);


$products_db = new ProductsDb();
$all_products = [];
$order_value = 0;
?>

<!-- om count $orders är lika med noll så ska della kod visas -->
<?php if (count($orders) == 0) : ?>
    <?php if ($is_logged_in) : ?>
    <div class="empty-cart">
        <a class="link-oops" href="/pages/products.php">Ooops... Här var det tomt. Gå till produkter</a>
    </div>
    <?php endif; ?>
<?php endif; ?>


<!-- om ingen är inloggad så visas denna kod med länk till login.php -->
<?php
if (!$is_logged_in) : ?>
    <a class="users-name" href="/pages/login.php"><p class="users-name" style="text-decoration=none; ">Logga in för att lägga beställning</p></a>
<?php endif; ?>
<br>


<!-- om count $orders är större än noll så visas denna kod med alla orders på det inloggade IDt -->
<?php if (count($orders) > 0) : ?>
    <?php if ($is_logged_in) : ?>
<h2 class="admin-heading">Mina ordrar:</h2>
<hr style="margin:.7%;">
<div class="admin-content-center">



<?php foreach ($orders as $order) : ?>
    <div class="admin-orders-container">
    <div class="admin-box-order">
        <div class="admin-box-left">
            <p class="users-role">Användar ID - <i class="users-order"><?=$order->user_id?></i></p></br>
            <p class="users-role">Beställnings ID - <i class="users-order"><?=$order->id?></i></p></br>
        </div>
        <div class="admin-box-left">
            <p class="users-role">STATUS - <i class="users-order"><?= $order->status ?></i></p></br>
            <p class="users-role">DATUM: <i class="users-order"><?= $order->order_date?> </i></p></br>
        </div>
    </div>



    

    <?php 
    // loopar runt producten i varje order
    $products = $products_db->get_by_orderid($order->id);
    foreach ($products as $product) {
    $order_value += $product->price;
    } ?>

    <?php foreach ($products as $product) : ?>
        <hr>
    <?php array_push($all_products, $product); ?>
    <div class="admin-box" style="padding: 5%;">
    <div class="admin-box-right">
        <p class="users-order"><?= $product->title ?></i></p>
    </div>
    <div class="admin-box-right">
        <img src="<?= $product->img_url ?>" width="50" height="50" alt="Arthusen_">
    </div>
    </div>
    <?php endforeach; ?>

<!-- räknar ut totalen för varje order -->
<hr>
    <p class="users-role h4-pad"><b> Totalt:
    <?= $order_value ?> kr</b></p>
    <?php $order_value = 0; ?>
    </div>

<?php endforeach; ?>
</div>



<?php
if ($is_logged_in && $order_value > 0) : ?>
    <?php $products = $products_db->get_by_orderid($logged_in_user->id);?>
<div>
<h2 class="admin-heading">Summa: <?= $sum = array_reduce($all_products, function ($arr, $value) {
                return $arr + $value->price;
            })  ?> Kr </h2>
</div>
<?php endif; ?>
    <?php endif; ?>
<?php endif; ?>




<?php
Template::footer();