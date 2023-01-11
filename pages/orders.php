<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/OrdersDatabase.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/ProductsDatabase.php";


//$logged_in_user = $_SESSION["user"];



$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

Template::header("Order page");


$orders_db = new OrdersDatabase();
$orders = $orders_db->get_one_by_userid($logged_in_user->id);



/*$products_db = new ProductsDatabase();
$products = [];
 $order_value = 0;  */

?>
<h2>Mina ordrar</h2>


<?php
if (!$is_logged_in) : ?>
    <a href="/register.php"></i>Login/register to place order</a>

<?php endif; ?>



<?php foreach ($orders as $order) : ?>

    <hr><br>

    <p>
        <b><p>USERID: </p></b><?=$order->user_id?>
        <b><p>STATUS: </p></b><?= $order->status ?>
        <b><p>DATE: </p></b><?= $order->order_date?>
    </p>

<?php endforeach; ?>