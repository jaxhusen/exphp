<?php
/*  OrdersDb för att kunna använda den infon + forceadmin för att du måste va authorized*/
require_once __DIR__ . "/../classes/OrdersDb.php";
require_once __DIR__ . "/force-admin.php";

$success = false;

/* ta bort en order med sql från OrderDb och det görs via orderns ID */
if (isset($_POST["id"])) {
    $orders_db = new OrdersDb();
    $success = $orders_db->delete($_POST["id"]);//här körs DELETE koden
} else {
    die("Felaktig inmatning");
}


if ($success) {
    header("Location: /pages/admin-orders.php");//om du lyckas skickas du tillbaks till admin
    die();
} else {
    die("Kunde inte ta bort order");
}