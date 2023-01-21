<?php
 
//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';
 
//Make object of Google API Client for call Google API
$google_client = new Google_Client();
 
//Set the OAuth 2.0 Client ID
$google_client->setClientId('612395601619-7nrvq1cga6om0ntjts0q2rovdom8o9en.apps.googleusercontent.com');
 
//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');
 
//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost:8888/google/googlelogin.php');
 
//
$google_client->addScope('email');
 
/* $google_client->addScope('profile'); */
 
//start session on web page
if(session_id() == ""){
    session_start();
    }
?>