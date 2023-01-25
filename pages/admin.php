<?php
/* Läser in Template för basinfo, ProductsDb + UsersDb + OrdersDb + MsgDb för att kunna använda den infon */
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

/* kallar på koden för att hämta alla meddelanden*/
$msg_db = new MsgDb();
$messages = $msg_db->get_all_msg(); 

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

<!-- Kod för att skapa en ny product och sen skcikas till sidan 'post-create-product.php' -->
 <h2 class="admin-heading"> Skapa produkt </h2>
 <hr style="margin:.7%;">
 <div class="form-container">
<form class="form-login" action="/scripts/post-create-product.php" method="post" enctype="multipart/form-data">
    <input class="form-input" type="text" name="title" placeholder="Titel"> <br>
    <input class="form-input" type="number" name="price" placeholder="Pris"><br>
    <input class="form-input" type="file" name="image" accept="image/*"><br>
    <div class="form-btns">
        <input class="user-regitration" type="submit" value="Spara">
    </div>
</form> 
</div>

<!-- Kod för att lista alla produkter  -->
<h2 class="admin-heading"> Produkter </h2>
<hr style="margin:.7%;">
<div class="admin-users">
        <div class="admin-users-box">
<?php foreach ($products as $product) : ?>
        <div class="admin-user-card row-space-between">
            <div class="text-left-admin-products">
                <a class="users-name" href="/pages/admin-product.php?id=<?= $product->id ?>">
                <?= $product->title ?></a> 
                <i class="users-role"> - <?= $product->price ?> :-</i></br>
            </div>
            <div class="pic-right-admin-products">
                <img src="<?= $product->img_url ?>" height="70px" width="70px"></i></br>
            </div>
        </div>
<?php endforeach; ?>
</div>
</div>

<!-- Kod för att lista alla användare  -->
<h2 class="admin-heading"> Användare </h2>
<hr style="margin:.7%;">
<div class="admin-users">
        <div class="admin-users-box">
<?php foreach ($users as $user) : ?>
<div class="admin-user-card row-space-between">
<div class="text-left-admin-products">
            <a class="users-name" href="/pages/admin-user.php?username=<?= $user->username ?>"><?= $user->username ?></a>
        <i class="users-role">- <?= $user->role ?></i></br>
</div>
<div class="pic-right-admin-products">
                <img src="<?= $user->img_url ?>" height="70px" width="70px"></i></br>
            </div>
        </div>
<?php endforeach; ?>
</div>
</div>


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


<!-- Kod för att lista alla meddelanden  -->
<h2 class="admin-heading">Alla meddelanden</h2>
<hr style="margin:.7%;">
    <div class="admin-orders-master">
    <?php foreach ($messages as $message) : ?>

        <div class="admin-orders-container">
        <div class="admin-box">
            <div class="admin-box-left">
            <input type="hidden" name="id" value="<?= $_GET["username"] ?>">
                <p class="users-role">Meddelande ID - <i class="users-order"><?= $message->id ?></i></p></br>
                <p class="users-role">Användare - <i class="users-order"> <?= $message->username ?> </i></p></br>
            </div>
        </div>

        <div class="admin-box">
            <input type="hidden" name="id" value="<?= $message->id ?>">
                <div class="admin-box-left">
                        <p class="users-role">Meddelande - <i class="users-order"> <?= $message->message ?></i></p></br>
                        <p class="users-role">Status - <i class="users-order">  <?= $message->status ?> </i></p></br>
                </div>
            </div>

<!-- Kod för att uppdatera status på meddelande och sen skickar till 'post-update-message.php'  -->
            <div class="admin-box">
            <div class="admin-box-right">
            <form action="/scripts/post-update-message.php" method="post" class="row">
                <input type="hidden" name="id" value="<?= $message->id ?>">
                <select name="status">
                    <option disabled selected>Status</option>
                    <option value="Skickad">Skickad</option>
                    <option value="Mottagen">Mottagen (svar inom 3-6 dagar)</option>
                </select>
                <input type="submit" value="Spara" class="user-regitration">
            </form>
            </div>
            
            <div class="admin-box-right">
                <form action="/scripts/post-delete-message.php" method="post">
                    <input type="hidden" name="id" value="<?= $message->id ?>">
                    <input class="admin-order-delete" type="submit" value="Radera meddelande">
                </form>
            </div>
        </div>


    </div>
        <?php endforeach; ?>
    </div>




<?php

Template::footer();

?>