<?php
require_once(dirname(__FILE__) . "/../config.php");  
require_once __DIR__ . "/../classes/Template.php";


Template::header("Register user");
?>


<div class="form-container">
    <form class="form-login" action="/scripts/post-register-user.php" method="post">
        <input class="form-input" type="text" name="username" autofocus placeholder="Username"><br>
        <input class="form-input" type="password" name="password" autofocus placeholder="Password"><br>
        <input class="form-input" type="password" name="confirm-password" autofocus placeholder="Confirm password"><br>
        <div class="form-btns">
            <input class="user-regitration" type="submit" value="Register">
            <?php

           if(isset($_SESSION['user_token'])){
                header("Location: /login.php");
            }else{
            echo "<a href='" . $client->createAuthUrl() . "'> Google login</a>";
            } 
            ?>
        </div>
    </form>
    </div>

<?php
Template::footer();
?>