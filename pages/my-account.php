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
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDb.php";


Template::header("Mitt konto");
?>


<div class="my-account-container">
    <div class="my-account-top-container">
        <div class="account-img">
            <img src=""></img>
            <input type="file" name="item-img" id="item-img">
            <input type="button" value="Spara">
        </div>
        <div class="account-img-text">
            <p>
                LOREM IPSUM
            </p>
        </div>
    </div>
        <div class="my-account-bottom-container">
            <div class="my-account-text">
                <p>
                    LOREM IPSUM
                </p>
            </div>
        </div>


    </div>
</div>


<?php
Template::footer();
?>
</body>
</html>