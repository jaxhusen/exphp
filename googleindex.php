<?php
require_once 'googleconfig.php';

if (isset($_SESSION['user_token'])) {
  header("Location: googlelogin.php");
} else {
  echo "<a href='" . $client->createAuthUrl() . "'>Google Login</a>";
}