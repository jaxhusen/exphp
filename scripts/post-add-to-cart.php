<?php
/*  Product + ProductDb för att kunna använda den infon */
require_once __DIR__ . "/../classes/ProductsDb.php";
require_once __DIR__ . "/../classes/Product.php";


session_start();

if(isset($_POST["product-id"])){
    //hämta en product från PRoductDb vi klickat på
    $products_db = new ProductsDb();
    $product = $products_db->get_one($_POST["product-id"]);


    //skapa varukorg om den inte finns
    if(!isset($_SESSION["cart"])){
        $_SESSION["cart"] = [];
    }

   
    if($product){
        //lägg produkt i varukorg
        $_SESSION["cart"][] = $product;
        //redirect till pages->products
        header("Location: /pages/products.php");
        die();
    }


}else{
    die("Felaktig inmatning");
}
die("Kunde inte spata produkt i varukorg");