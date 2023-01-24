<?php
/* Läser in Template för basinfo */
require_once __DIR__ . "/../classes/Template.php";


Template::header("");
?>

<!--  form för att registrera användare och skickas till post-register-user -->
<div class="form-container">
    <form class="form-login" action="/scripts/post-register-user.php" method="post">
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