<?php
/* Läser in Template för basinfo, UsersDb + meddelandeDb för att kunna använda den infon */
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/MsgDb.php";
require_once __DIR__ . "/../classes/UsersDb.php";


session_start();
$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;


Template::header('');


/* om du är inloggad så kommer detta from upp, när du klickat på skicka så flyttas du till success-msg-sent.php */
if ($is_logged_in) : ?>
    <div class="form-container" style="margin-top:5%; margin-bottom: 5%;">
        <form class="form-contaus" action="/pages/success-msg-sent.php" method="post" enctype="multipart/form-data">
            <h4 class="h4-pad">Kontakta oss här:</h4>
            </br>
            <input class="form-input" type="text" name="username" placeholder="Användarnamn" value="<?= $message->user ?>">
            <textarea class="form-input" name="message" placeholder="Skriv ditt meddelande / önskemål här" style="margin-top: 2%"></textarea>
            
            <div class="form-btns" style="margin-top: 2%;">
                <input class="user-regitration" type="submit" value="Skicka">
            </div>
        </form> 
</div>

<!-- om du inte är inloggad kommer en länk till login.php visas -->
<?php else: ?>
     <?php if (!$is_logged_in) : ?>
    <div class="empty-cart">
        <a class="link-oops" href="/pages/login.php"></i>Logga in för att skicka meddelande</a>
    </div>


<?php endif ; ?> 
<?php endif ; ?>

<?php
    Template::footer();