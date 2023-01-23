<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDb.php";


Template::header("Logga in");
?>


<div class="form-container">
<form class="form-login" action="/scripts/post-login.php" method="post">
    <h2 class="wrong">Fel användarnamn eller lösenord</h2>
    <input class="form-input" type="text" name="username" autofocus placeholder="Användarnamn"><br>
    <input class="form-input" type="password" name="password" autofocus placeholder="Lösenord"><br>
    <div class="form-btns">
        <input class="login-user" type="submit" value="Logga in">
        <a class="register-user" href="/./pages/register.php"> Registrera användare </a>
    </div>
</form>
</div>


<?php
Template::footer();
?>