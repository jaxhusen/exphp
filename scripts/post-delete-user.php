<?php
/*  userDB för att kunna använda den infon + forceadmin för att du måste va authorized*/
require_once __DIR__ . "/../classes/UsersDb.php";
require_once __DIR__ . "/force-admin.php";

$success = false;

/* ta bort en användare med sql från MsgDb och det görs via användarens username */
if(isset($_POST["username"])){
    $users_db = new UsersDb();
    $success = $users_db->delete($_POST["username"]);//här körs DELETE koden
}else{
    die("Felaktig inmatning");
}

if($success){
    header("Location: /pages/admin.php");//om du lyckas skickas du tillbaks till admin
    die();
}else{
    die("Kunde inte ta bort användare");
}