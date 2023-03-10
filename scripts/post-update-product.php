<?php
/*  Productdb för att kunna använda den infon + forceadmin för att du måste va authorized*/
require_once __DIR__ . "/../classes/ProductsDb.php";
require_once __DIR__ . "/force-admin.php";

$success = false;

/* om du satt title och pris så kan du lägga till en bild i producten också, id via _GET automatiskt */
if (isset($_POST["title"]) && isset($_POST["price"]) && isset($_GET["id"])) {
    $upload_directory = __DIR__ . "/../assets/uploads/";
    $upload_name = basename($_FILES["img_url"]["name"]); // katt.jpeg
    $name_parts = explode(".", $upload_name); // ["katt", "jpeg"]
    $file_extension = end($name_parts); // "jpeg"
    $timestamp = time();  // "16237892"
    $file_name = "{$timestamp}.{$file_extension}"; // "16237892.jpeg"
    $full_upload_path = $upload_directory . $file_name;
    $full_relative_url = "/assets/uploads/{$file_name}";
    $success = move_uploaded_file($_FILES["img_url"]["tmp_name"], $full_upload_path);


    $product = new Product($_POST["title"], $_POST["price"], $full_relative_url);
    $products_db = new ProductsDb();
    $success = $products_db->update($product, $_GET["id"]);//här uppdateras den

} else {
    die("Felaktig inmatning");
}

if ($success) { //om du lyckas skickas du tillbaks till admin-sidan 
    header("Location: /pages/admin-products.php");
    die();
} else {
    die("Gick ej att spara produkt");
}