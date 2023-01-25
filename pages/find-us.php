<?php
/* Läser in Template för basinfo, UsersDb för att kunna använda den infon */

 $office = "Gran Canaria, youmbo center"; //variabel för kontoret som visas i kartan
 $lat2 = 27.758183; //koordinaterna för att kunna räkna ut avståndet mellan kund och kontor
 $long2 = -15.576836; //koordinaterna för att kunna räkna ut avståndet mellan kund och kontor
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDb.php";


Template::header("");
   echo '<h2 class="admin-heading"> Long / Lat</h2>';
   echo '<hr style="margin:.7%;">';
   
   /* om båda fältet fyllts i korrekt och du klickat på submit_coordinates så körs denna kod */
if(isset($_POST["submit_coordinates"])){
    $lat1 = $_POST["lat1"]; 
    $long1 = $_POST["long1"];
    $distance = calculateDistance($lat1, $long1, $lat2, $long2); 
    //sparar koordinaterna i variabeln $distance och funktionen CalculateDistance körs


   ?>
<?php
} ?>

<!-- efter allt är ifyllt skickas du till sidan post-find-us.php -->
<div class="form-container">
    <form method="POST" action="/../scripts/post-find-us.php" class="form-login">
        <div class="form-btns">
            <input class="form-input" type="text" name="lat1" placeholder="Skriv in latitude">
            <input class="form-input" name="long1" placeholder="Skriv in longitude">
</div>
            <input class="user-regitration" type="submit" name="submit_coordinates">
    </form> 
</div>

<!-- kod för function calculateDistance -->
    <?php
function calculateDistance($lat1, $long1, $lat2, $long2){
    $first = $long1 - $long2;
    $distance = (sin(deg2rad($lat1))) * 
              sin(deg2rad($lat2)) + 
             (cos(deg2rad($lat1)) * 
              cos(deg2rad($lat2)) *
              cos(deg2rad($first)));
    $distance = acos($distance);
    $distance = rad2deg($distance);
    $distance = $distance * 1.609344; 

    return $distance;
}
?>

<!-- google maps på "kontoret" på gran canaria, deklarerad i $office högst upp -->
 <iframe class="map" src="https://www.google.com/maps?q=<?php echo $office?>&output=embed"></iframe>


<?php
Template::footer();
