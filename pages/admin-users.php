<?php
/* Läser in Template för basinfo,  UsersDb +  för att kunna använda den infon */
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDb.php";


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




Template::header(""); ?>

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





<?php

Template::footer();

?>