<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDb.php";

Template::header("Logga in");



if(isset($_GET["register"]) && $_GET["register"] == "success"){
    echo "<h2> User registered, log in </h2>";
}

if(isset($_GET["error"]) && $_GET["error"] == "wrong_pass") : ?>
<h2>Wrong username or password! </h2>
<?php endif; ?>



<div class="form-container">
<form class="form-login" action="/scripts/post-login.php" method="post">
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