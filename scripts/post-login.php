<?php
require_once __DIR__ . "/../classes/UsersDb.php";

if(isset($_POST["username"]) && isset($_POST["password"])){
    $users_db = new UsersDb();
    $user = $users_db->get_one_by_username($_POST["username"]);


    if($user && $user->test_password($_POST["password"])){
        session_start();
        $_SESSION["user"] = $user;
        header("Location: /");
    }else{
        header("Location: /pages/login.php?error=wrong-user-or-pass");
        die();
    }

}else{
    die("Invalid input");
}