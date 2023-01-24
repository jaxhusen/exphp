<?php
/* koden stänger ner sessionen och användaren loggas ut och skickas till startsida */

session_start();
unset($_SESSION["user"]);
session_destroy();
header("Location: /");