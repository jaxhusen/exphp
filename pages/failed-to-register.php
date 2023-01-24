<?php
/* Läser in Template för basinfo, UsersDb för att kunna använda den infon */
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDb.php";


Template::header("Logga in");
?>

<!-- Om du skriver in anv namn som redan finns i databasen users på register.php så skickas du hit med felmeddelande på rad 12 -->
<div class="form-container">
<form class="form-login" action="/scripts/post-register-user.php" method="post">
    <h2 class="wrong">Användare finns redan</h2>
    <input class="form-input" type="text" name="username" autofocus placeholder="Username"><br>
        <input class="form-input" type="password" name="password" autofocus placeholder="Password"><br>
        <input class="form-input" type="password" name="confirm-password" autofocus placeholder="Confirm password"><br>
        <div class="form-btns">
            <input class="user-regitration" type="submit" value="Register">
        </div>
    </form>
</div>


<?php
Template::footer();
?>