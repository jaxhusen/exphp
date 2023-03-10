<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
/* Läser in Template för basinfo, UsersDb för att kunna använda den infon */
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDb.php";


Template::header("");
?>

<h2 class="admin-heading">Q and A</h2>
<hr style="margin:.7%;">

<!-- accordion funktioner läses in via accordion.js som är kopplat längre ner på sidan -->
<div class="accordion-container">
    <button class="accordion-head">Hur lång leveranstid är det?</button>
    <div class="accordion-text">
        <p class="inside-accordion">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <button class="accordion-head">Kan man lägga önskemål på tavlor?</button>
    <div class="accordion-text">
        <p class="inside-accordion">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <button class="accordion-head">Hur får man jobb hos er?</button>
    <div class="accordion-text">
        <p class="inside-accordion">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
</div>

<script src="/../assets/accordion.js"></script>


<?php
Template::footer();
?>
</body>
</html>