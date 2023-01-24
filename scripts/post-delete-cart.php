<?php
session_start();

/* om du klickar på delete så nollas hela carten och du skickas tillbaka till cart */
if (isset($_SESSION["cart"])){$_SESSION["cart"] = [];
header("Location: /pages/cart.php");
die();
}