<?php 
require_once __DIR__ . '/../classes/Msg.php';
require_once __DIR__ . '/../classes/MsgDb.php';

$success = false;

    $msg = new Msg($_POST["username"], $_POST["message"], $_POST["reply"]);
    $msg_db = new MsgDb();

    $success = $msg_db->send_message($msg);

    if($success) {
        header("Location: /pages/message.php");
        echo "<p>Message Sent!</p>";
    }

    else{
        die("error sending message");
    }
?>