<?php

require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDb.php";
$success = false;



if(
    isset($_POST["username"]) &&
    isset($_POST["password"]) &&
    isset($_POST["confirm-password"]) &&

    strlen($_POST["username"]) > 0 &&
    strlen($_POST["password"]) > 0 &&
    $_POST["password"] === $_POST["confirm-password"]){
        $users_db = new UsersDb();
        $user = new User($_POST["username"], 'Kund');
        $user->hash_password($_POST["password"]);
        $existing_user = $users_db->get_one_by_username($_POST["username"]);


        if($existing_user){
            header("Location: /pages/failed-to-register.php");
        }else{
            $success = $users_db->create($user);
        }

    }else{
        die("Invalid input");
    }


if($success){  
    header("Location: /pages/login.php?register=success");
}else{
    die("Error saving user");
}