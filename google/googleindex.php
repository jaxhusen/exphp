<?php

  //Include Google Configuration File
  require_once __DIR__ . "/googleconfig.php";

  if(!isset($_SESSION['access_token'])) {
   //Create a URL to obtain user authorization
   $google_login_btn = '<a href="' . $google_client->createAuthUrl() . '">Login with Google</a>';
  } else {
    header("Location: googlelogin.php");
  }
?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PHP Login With Google</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
 </head>
 <body>
  <div class="container">
   <br />
   <h2>PHP Login With Google</h2>
   <br />
   <div class="panel panel-default">
   <?php
    echo '<div align="center">'.$google_login_btn . '</div>';
   ?>
   <a href="/../index.php">Home</a>
   </div>
  </div>
 </body>
</html>