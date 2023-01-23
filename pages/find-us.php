<?php
$office = "Gran Canaria, youmbo center";
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDb.php";

Template::header("Hitta hit");
?>
<?php
    if(isset($_POST["submit_adress"])){
        $adress = $_POST["adress"]; ?>
<iframe class="map" src="https://www.google.com/maps?q=<?php echo $office;?>&output=embed"></iframe>
<?php
    }
?>
    <form method="POST">
        <p>
            <input type="text" name="adress" placeholder="Skriv in din adress">
        </p>
            <input type="submit" name="submit_adress">
    </form>

 

<?php
Template::footer();
