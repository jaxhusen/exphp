<?php
/* Läser in Template för basinfo, UsersDb för att kunna använda den infon */
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDb.php";


Template::header("");
?>

<!-- Form för att logga in användare, if success -> post-login  -->
<!-- Om du har skapat ett konto på register.php så visas success meddelandet på rad 16 -->
<div class="form-container">
<form class="form-login" action="/scripts/post-login.php" method="post">
<?php
 if(isset($_GET["register"]) && $_GET["register"] == "success"){
    echo "<h5> Användare registrerad </h5>";
}
?>
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