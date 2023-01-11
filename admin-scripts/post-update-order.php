<?php
require_once __DIR__ . "/../classes/OrdersDatabase.php";

require_once __DIR__ . "/force-admin.php";



$success = false;



if(isset($_GET["id"]) && isset($_POST["status"])){

$orders_db = new OrdersDatabase();

$success = $orders_db->update_order_status($_GET["id"], $_POST["status"]);

}




else{

    die("Invalid input!!!!");

}

if($success){

    header("Location: /pages/admin.php");

    die();

}

else{

    die("Error updating order");

}