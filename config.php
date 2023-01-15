<?php
/* https://www.youtube.com/watch?v=M4jde7THXAI */
require_once '/../classes/Database.php';
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


?>