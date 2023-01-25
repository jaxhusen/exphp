<?php
/* Läser in Template för basinfo, UsersDb + MsgDb för att kunna använda den infon */
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



Template::header(""); ?>

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