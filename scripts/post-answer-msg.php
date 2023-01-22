<?php 
require_once __DIR__ . '/../classes/Msg.php';
require_once __DIR__ . '/../classes/MsgDb.php';



 $success = false;

if (isset($_POST["id"]) && isset ($_POST["reply"])) {
    $reply_db = new MsgDb();

    $success = $reply_db->reply_message($_POST["id"], $_POST["reply"]);
} else {
        die("Invalid input");
}

if ($success) {
    header("Location: /pages/message.php"); 
    die();
} else {
    die("Error replying message");
}