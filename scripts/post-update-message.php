<?php
/* läs in messageDb för att kunna använda den infon och force-admin för du måste va authorized */
require_once __DIR__ . "/../classes/MsgDb.php";
require_once __DIR__ . "/force-admin.php";

$success = false;


//om du valt meddelande och ändrat status så kallar den på update_message_status
if(isset($_POST["id"]) && isset($_POST["status"])){
$message_db = new MsgDb();
$success = $message_db->update_message_status($_POST["id"], $_POST["status"]);
}else{
    die();
}

if($success){
    header("Location: /pages/admin-messages.php");  //om allt är OK så skickas du till admin.php
    die();
}else{
    die("Fel vid uppdatering av meddelande"); // annars error
}