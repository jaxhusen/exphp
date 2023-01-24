<?php 
/* läser in meddelandeDb och meddelande för att kunna använda den infon */
require_once __DIR__ . '/../classes/Msg.php';
require_once __DIR__ . '/../classes/MsgDb.php';

 $success = false;

 //läser in de du skrivit i alla fälten och skapar nytt meddelande
    $message = new Msg($_POST["username"], $_POST["message"], 'Skickat');
    $message_db = new MsgDb();

    $success = $message_db->send_message($message);// kallar på send_message i message_db

    if($success) {
        header("Location: /pages/message.php"); //om success så skrivs ett meddelande ut i message.php
    }else{

        die("Fel när meddelandet skulle skickas"); //annars error
    }