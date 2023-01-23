<?php 
require_once __DIR__ . '/../classes/Msg.php';
require_once __DIR__ . '/../classes/MsgDb.php';

 $success = false;

    $message = new Msg($_POST["username"], $_POST["message"], 'Skickat');
    $message_db = new MsgDb();

    $success = $message_db->send_message($message);

    if($success) {
        header("Location: /pages/message.php");
        echo "<p class='confirmation'>Message Sent!</p>";
    }else{

        die("error sending message");
    }