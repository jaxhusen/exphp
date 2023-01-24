<?php
/*usersDb, user för att kunna använda den infon */
require_once __DIR__ . "/../classes/User.php";
require_once __DIR__ . "/../classes/UsersDb.php";
$success = false;



if(
    isset($_POST["username"]) && // om allt detta är iskrivet 
    isset($_POST["password"]) && // om allt detta är iskrivet 
    isset($_POST["confirm-password"]) && // om allt detta är iskrivet 

    strlen($_POST["username"]) > 0 && //och kollar så username är fler tecken än 0
    strlen($_POST["password"]) > 0 && //och kollar så password är fler tecken än 0
    $_POST["password"] === $_POST["confirm-password"]){ // och lösen stämmer med lösen
        $users_db = new UsersDb();
        $user = new User($_POST["username"], 'Kund');
        $user->hash_password($_POST["password"]);
        $existing_user = $users_db->get_one_by_username($_POST["username"]); // finns det redan en med samma anv namn?


        if($existing_user){
            header("Location: /pages/failed-to-register.php"); // då blir de failed-to-register.php
        }else{
            $success = $users_db->create($user); //annars skapas en ny användare här tack vare sql i usersDb
        }

    }else{
        die("Felaktig inmatning"); //annars error
    }


if($success){  
    header("Location: /pages/login.php?register=success"); 
}else{
    die("Fel när användare skulle sparas"); //annars error
}