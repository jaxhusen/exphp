<?php

require_once './vendor/autoload.php';

session_start();

// init configuration
$clientID = '612395601619-7nrvq1cga6om0ntjts0q2rovdom8o9en.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost:8888/googlewelcome.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// Connect to database
$hostname = "localhost";
$username = "root";
$password = "root";
$database = "orderinfo-db";

$conn = mysqli_connect($hostname, $username, $password, $database);