<?php
/* User för att kunna använda den infon */
require_once __DIR__ . "/../classes/User.php";

session_start();

/* är den inloggade kund eller admin ??? */
$is_logged_in = isset($_SESSION["user"]);
$logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
$is_admin = $is_logged_in && $logged_in_user->role == "admin";


/* om du inte är admin är de ACCESS DENIED */
if(!$is_admin){
    http_response_code(401);
    die("Tillräde nekat");
}