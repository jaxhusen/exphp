<?php
/* usersDb för att kunna använda den infon */
require_once __DIR__ . "/../classes/UsersDb.php";

/* om du skrivit om username och pass så skrivs denna kod ut */
if(isset($_POST["username"]) && isset($_POST["password"])){
    $users_db = new UsersDb();
    $user = $users_db->get_one_by_username($_POST["username"]); //kallar på funktionen get_one_by_username från usersDb 


    if($user && $user->test_password($_POST["password"])){// om de stämmer överens
        session_start();
        $_SESSION["user"] = $user; //så startas session och du är inloggad + skickas till startsida 
        header("Location: /");
    }else{
        header("Location: /pages/failed-to-login.php"); //annars skcikas du till failed-to-login.php med felmeddelande på vad som gick fel
    }

}else{
    die("Felaktig inmatning");// annars invalid inoput
}