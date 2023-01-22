<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/MsgDb.php";

$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;
$is_admin = $is_logged_in && ($logged_in_user->role == 'admin');

$msg_db = new MsgDb();
$messages = $msg_db->get_all();

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
        <form action="/scripts/post-send-msg.php" method="POST" autocomplete="off" class="form-login">
            <input class="form-input" type="text" name="username" id="username" placeholder="Användarnamn">
            <textarea class="form-input"  style="margin-top: 2%" name="message" id="message" placeholder="Meddelande"></textarea>
            <div class="form-btns" style="margin-top: 2%">
                <input class="user-regitration" type="submit" value="Skicka" style="width: 92%">
            </div>
        </form>
    </div>


    <h2 class="admin-heading">Alla meddelanden</h2>
<hr style="margin:.7%;">
    <div class="admin-orders-master">
    <?php foreach ($messages as $message) : ?>

        <div class="admin-orders-container">
        <div class="admin-box">
            <div class="admin-box-left">
                <p class="users-role">Meddelande ID - <i class="users-order"><?= $message->id ?></i></p></br>
                <p class="users-role">Beställnings ID - <i class="users-order"> <?= $message->username ?> </i></p></br>
            </div>
        </div>

        <div class="admin-box">
                <form action="/scripts/post-answer-msg.php" method="POST" autocomplete="off" class="row">
                    <input type="hidden" name="id" value="<?= $message->id ?>">
                    <div class="admin-box-left">
                        <p class="users-role">Meddelande - <i class="users-order"> <?= $message->message ?></i></br>
                        <p class="users-role">Svar - <i class="users-order">  <?= $message->reply ?> </i></p></br>
                    </div>
                </form>
            </div>
    </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>



    <?php
    Template::footer();