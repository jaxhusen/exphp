<?php
require_once __DIR__ . "/../classes/OrdersDb.php";
require_once __DIR__ . "/force-admin.php";

$success = false;



if(isset($_POST["id"]) && isset($_POST["status"])){
$orders_db = new OrdersDb();
$success = $orders_db->update_order_status($_POST["id"], $_POST["status"]);
}else{
    die("Invalid input post-edit-order.php");
}

if($success){
    header("Location: /pages/admin.php");
    die();
}else{
    die("Error updating order");
}