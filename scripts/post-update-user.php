<?php
/* läser in usersDb för att kunna använda innehållet och force-admin för att kunna se om användare är authorized */
require_once __DIR__ . "/../classes/UsersDb.php";
require_once __DIR__ . "/force-admin.php";

$success = false;

//om du valt användare och ändrat roll så kallar den på update i usersDb
if(isset($_POST["role"]) && isset($_GET["username"])){
$user_db = new UsersDb();
$user = new User($_GET["username"], $_POST["role"]);
$success = $user_db->update($user); //här uppdateras den

}
else{
    die("Felaktig inmatning");
}
if($success){
    header("Location: /pages/admin-users.php");//om allt är OK så skickas du till admin.php
    die();
}
else{
    die("Fel vid uppdatering av användare");// annars error
}