<?php
/*  ProductDB för att kunna använda den infon + forceadmin för att du måste va authorized*/
require_once __DIR__ . "/../classes/ProductsDb.php";
require_once __DIR__ . "/force-admin.php";


$success = false;

/* ta bort en produkt med sql från productDb och det görs via productens ID */
if(isset($_POST["id"])){
    $products_db = new ProductsDb();
    $success = $products_db->delete($_POST["id"]);//här körs DELETE koden
}else{
    die("Felaktig inmatning");
}


if($success){
    header("Location: /pages/admin-products.php");//om du lyckas skickas du tillbaks till admin
    die();
}else{
    die("Kunde inte ta bort produkt");
}