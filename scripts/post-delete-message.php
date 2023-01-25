<?php
/*  meddelandeDB för att kunna använda den infon + forceadmin för att du måste va authorized*/
require_once __DIR__ . "/../classes/MsgDb.php";
require_once __DIR__ . "/force-admin.php";

$success = false;

/* ta bort ett meddelande med sql från MsgDb och det görs via meddelandets ID */
if (isset($_POST["id"])) {
    $message_db = new MsgDb();
    $success = $message_db->delete($_POST["id"]); //här körs DELETE koden
} else {
    die("Felaktig inmatning");
}


if ($success) {
    header("Location: /pages/admin-messages.php");//om du lyckas skickas du tillbaks till admin
    die();
} else {
    die("Kunde inte ta bort meddelande");
}