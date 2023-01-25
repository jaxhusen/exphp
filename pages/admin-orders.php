<?php
/* Läser in Template för basinfo, ProductsDb + UsersDb + OrdersDb för att kunna använda den infon */
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDb.php";
require_once __DIR__ . "/../classes/UsersDb.php";
require_once __DIR__ . "/../classes/OrdersDb.php";
require_once __DIR__ . "/../classes/MsgDb.php";

//kontrollera att användaren är inloggad som admin
$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

//om dom inte är admin
if (!$is_admin) { 
    http_response_code(401); // access denied
    die("Access denied!!");
}


/* kallar på koden för att hämta alla användare*/
$users_db = new UsersDb();
$users = $users_db->get_all();

/* kallar på koden för att hämta alla prodkter*/
$products_db = new ProductsDb();
$products = $products_db->get_all();

/* kallar på koden för att hämta alla ordrar*/
$orders_db = new OrdersDb();
$orders = $orders_db->get_all();


Template::header(""); ?>



<!-- Kod för att lista alla ordrar  -->
<h2 class="admin-heading">Alla ordrar</h2>
<hr style="margin:.7%;">
<div class="admin-orders-master">
<?php foreach ($orders as $order) : ?>

    <div class="admin-orders-container">
        <div class="admin-box">
            <div class="admin-box-left">
                <p class="users-role">Användar ID - <i class="users-order"> <?= $order->user_id ?> </i></p></br>
                <p class="users-role">Beställnings ID - <i class="users-order"> <?= $order->id ?> </i></p></br>
            </div>
            <div class="admin-box-left">
                <p class="users-role">STATUS - <i class="users-order"> <?= $order->status ?> </i></p></br>
                <p class="users-role">DATUM - <i class="users-order">  <?= $order->order_date ?>  </i></p></br>
            </div>
        </div>

<!-- Kod för att uppdatera status på order och sen skickar till 'post-update-order.php'  -->
        <div class="admin-box">
            <div class="admin-box-right">
            <form action="/scripts/post-update-order.php" method="post" class="row">
                <input type="hidden" name="id" value="<?= $order->id ?>">
                <select name="status">
                    <option disabled selected>Status</option>
                    <option value="Väntande ..">Väntande ..</option>
                    <option value="Skickad">Skickad</option>
                </select>
                <input type="submit" value="Spara" class="user-regitration">
            </form>
            </div>
            
<!-- Kod för att raders en order och sen skickar till 'post-delete-order.php'  -->
            <div class="admin-box-right">
                <form action="/scripts/post-delete-order.php" method="post">
                    <input type="hidden" name="id" value="<?= $order->id ?>">
                    <input class="admin-order-delete" type="submit" value="Radera order">
                </form>
            </div>
        </div>
    </div>


<?php endforeach; ?>
</div>



<?php

Template::footer();

?>