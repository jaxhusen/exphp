<?php
require_once 'vendor/autoload.php'; 

/* https://www.youtube.com/watch?v=M4jde7THXAI */
$gClient = new Google_Client();
$gClient->setClientId('612395601619-7nrvq1cga6om0ntjts0q2rovdom8o9en.apps.googleusercontent.com');
$gClient->setClientSecret('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');
$gClient->setApplicationName("Arthusen");
$gClient->setRedirectUri('http://localhost:8888/pages/controller.php');
$gClient->addScope('https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email');

$login_url = $gClient->createAuthUrl();
?>