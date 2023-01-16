<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/OrdersDb.php";
require_once __DIR__ . "/../classes/UsersDb.php";
require_once __DIR__ . "/../classes/ProductsDb.php";

$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

Template::header("Order page");

$orders_db = new OrdersDb();
$orders = $orders_db->get_one_by_userid($logged_in_user->id);


$products_db = new ProductsDb();
$all_products = [];
$order_value = 0;


?>

<h2 class="admin-heading">Mina beställningar</h2>
<?php
if (!$is_logged_in) : ?>
    <a href="/pages/register.php"></i>Logga in för att lägga beställning</a>
<?php endif; ?>
<hr><br>



<?php foreach ($orders as $order) : ?>

    <div class="admin-orders-container">
    <div class="admin-box">
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


    <!-- loopar genom summan för varje order -->
    <?php foreach ($products as $product) : ?>
        <hr>
    <?php array_push($all_products, $product); ?>
    <div class="admin-box" style="padding: 5%;">
    <div class="admin-box-right">
        <p class="users-order"><?= $product->title ?></i></p>
        <i class="users-order"><?= $product->price ?>kr </i>
    </div>
    <div class="admin-box-right">
        <img src="<?= $product->img_url ?>" width="50" height="50" alt="Produkt bild">
    </div>
    </div>
    <?php endforeach; ?>


<hr>
    <p class="users-role h4-pad"><b> Totalt:
    <?= $order_value ?> kr</b></p>
    <?php $order_value = 0; ?>
    </div>

<?php endforeach; ?>



<?php $products = $products_db->get_by_orderid($logged_in_user->id);?>
<div>
<h2 class="admin-heading">Summa: <?= $sum = array_reduce($all_products, function ($arr, $value) {
                return $arr + $value->price;
            })  ?> Kr </h2>
</div>


<?php
Template::footer();