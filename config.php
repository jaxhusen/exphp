<?php
require_once 'vendor/autoload.php'; 
require_once "google-api/vendor/autoload.php";
session_start();

$clientID = '612395601619-7nrvq1cga6om0ntjts0q2rovdom8o9en.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost:8888/pages/login.php';

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setApplicationName("Arthusen");
$client->setRedirectUri($redirectUri);
$client->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

//connect to db
$hostname = "localhost";
$username = "root";
$password = "root";
$database = "orderinfo-db";

$conn = mysqli_connect($hostname, $username, $password, $database)

?>