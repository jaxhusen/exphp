<?php
/* Läser in Template för basinfo, ProductsDb för att kunna använda den infon */
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/ProductsDb.php";

//kontrollera att användaren är inloggad som admin
$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";

//om dom inte är admin
if (!$is_admin) { 
    http_response_code(401); // access denied
    die("Access denied!!");
}


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




<?php

Template::footer();

?>