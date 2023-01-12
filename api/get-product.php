<?php
require_once __DIR__ . "/../classes/ProductsDb.php";
header('Content-Type: application/json; charset=utf-8');


if(isset($_GET["id"])){
    $products_db = new ProductsDb();
    $product = $products_db->get_one($_GET["id"]);
    echo json_encode($product);
    die();
}

else{
    http_response_code(400);
    echo json_encode("Invalid input");
    die();
}