<?php
require_once __DIR__ . "/../classes/MsgDb.php";
require_once __DIR__ . "/force-admin.php";

$success = false;



if(isset($_POST["id"]) && isset($_POST["status"])){
$message_db = new MsgDb();
$success = $message_db->update_message_status($_POST["id"], $_POST["status"]);
}else{
    die("Invalid input");
}

if($success){
    header("Location: /pages/admin.php");
    die();
}else{
    die("Error updating message");
}