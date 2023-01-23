<?php
require_once __DIR__ . "/../classes/MsgDb.php";
require_once __DIR__ . "/force-admin.php";

$success = false;

if (isset($_POST["id"])) {
    $message_db = new MsgDb();
    $success = $message_db->delete($_POST["id"]);
} else {
    die("Invalid input");
}


if ($success) {
    header("Location: /pages/admin.php");
    die();
} else {
    die("Error deleting message");
}