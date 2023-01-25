<?php
/* läs in ordersDb för att kunna använda den infon och force-admin för du måste va authorized */
require_once __DIR__ . "/../classes/OrdersDb.php";
require_once __DIR__ . "/force-admin.php";

$success = false;


//om du valt order och ändrat status så kallar den på update_order_status
if(isset($_POST["id"]) && isset($_POST["status"])){
$orders_db = new OrdersDb();
$success = $orders_db->update_order_status($_POST["id"], $_POST["status"]);
}else{
    die(); // annars error
}

if($success){
    header("Location: /pages/admin-orders.php"); //om allt är OK så skickas du till admin.php
    die();
}else{
    die("Fel vid uppdatering av order"); //annars error
}