<?php
/*Template för basinfo + usersDb, product, ordersDb för att kunna använda den infon */
require_once __DIR__ . "/../classes/Product.php";
require_once __DIR__ . "/../classes/UsersDb.php";
require_once __DIR__ . "/../classes/OrdersDb.php";
require_once __DIR__ . "/../classes/Template.php";

$is_logged_in = isset($_SESSION['user']);
$cart = $_SESSION['cart'];
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;


if(!$cart){
    header("Location: /pages/cart.php");
}

//om du är inloogad och carten är mer än 0 så läggs en order med ett unikt ID, status- väntande.. och dagens datum
if ($is_logged_in && count($cart) > 0) {
    $order = new Order($logged_in_user->id, "väntande..", date("Y-m-d"));
    $db_orders = new OrdersDb();
    $order_id = $db_orders->create($order); // här skapas den tack vare sql i ordersDb


    if ($order_id == false) {
        die("Kunde inte skapa order"); //annars error
    }


    $success = true;
    foreach ($cart as $product) {
        $success = $success && $db_orders->create_order($order_id, $product->id); // här skapas den tack vare sql i ordersDb kopplingstabell
    }


    if ($success) {
        unset($_SESSION["cart"]);
        header("Location: /pages/orders.php"); //om success så skickas du till dina orders
        die();
    } else {
        die("Kunde inte spara order"); //annars error
    }
} else {
    die("Felaktig order / användare");//annars error
}