<?php
require_once __DIR__ . "/../classes/OrdersDb.php";
require_once __DIR__ . "/force-admin.php";

$success = false;

if (isset($_POST["id"])) {
    $orders_db = new OrdersDb();
    $success = $orders_db->delete($_POST["id"]);
} else {
    die("Invalid input");
}


if ($success) {
    header("Location: /pages/admin.php");
    die();
} else {
    die("Error deleting order");
}