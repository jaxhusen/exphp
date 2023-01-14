<?php
 require_once "/../classes/Controller.php";
 require_once(dirname(__FILE__) . "/../config.php"); 

if(isset($_GET['code'])){
    $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
    $gClient->setAccessToken($token['access_token']);
}else{
    header('Location: /');
    exit();
}

$oAuth = new Google_Service_Oauth2($gClient);
$userData = $oAuth->userinfo_v2_me->get();

echo "<pre>";
var_dump($userData);
echo "</pre>";
?>