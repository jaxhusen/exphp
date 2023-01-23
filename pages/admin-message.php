<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/MsgDb.php";
require_once __DIR__ . "/../classes/UsersDb.php";


$msg_db = new MsgDb();
var_dump($msg_db);
$messages = $msg_db->get_one_msg_by_username($_GET["username"]);


Template::header('');
?>


<?php
if (!$is_logged_in) : ?>
    <div class="empty-cart">
        <a class="link-oops" href="/pages/register.php"></i>Logga in för att skicka meddelande</a>
    </div>
<?php else : ?>



    <h2 class="admin-heading"> Kontakta oss </h2>
 <hr style="margin:.7%;">
 <div class="form-container">
        <form action="/scripts/post-send-msg.php?username=<?= $_GET["username"]?>" method="POST" class="form-login">
            <input class="form-input" type="text" name="username" id="username" placeholder="Användarnamn" value="<?= $message->username ?>">
            <textarea class="form-input"  style="margin-top: 2%" name="message" id="message" placeholder="Meddelande"></textarea>
            <select name="role">
        <option disabled selected>Status</option>
        <option value="admin">Skickat</option>
        <option value="customer">Mottaget</option>
    </select>
    <input type="submit" value="Spara" class="user-regitration">
        </form>
    </div>
    <?php endif; ?>



    <?php
    Template::footer();