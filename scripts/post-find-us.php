<?php
 $office = "Gran Canaria, youmbo center";
 $distance ="";
 $lat2 = 27.758183;
 $long2 = -15.576836;
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDb.php";


Template::header("Hitta hit");
?>
<?php

if(isset($_POST["submit_coordinates"])){
    $lat1 = $_POST["lat1"]; 
    $long1 = $_POST["long1"];
    $distance = calculateDistance($lat1, $long1, $lat2, $long2);  

   echo '<h2 class="admin-heading"> Long / Lat</h2>';
   ?>


<?php
} ?>
<div class="form-container">
    <form method="POST" action="/../scripts/post-find-us.php" class="form-login" style="width: 60%">
    <div class="p-text"> Avståndet mellan <?=$lat1 ?>, <?= $long1 ?> och Youmbo Centre, Gran Canaria är: <b><?= $distance ?></b> km</div>     
    <div class="form-btns">
            <input class="form-input" type="text" name="lat1" placeholder="Skriv in latitude">
            <input class="form-input" name="long1" placeholder="Skriv in longitude">
</div>
            <input class="user-regitration" type="submit" name="submit_coordinates">
    </form> 
</div>

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


 <iframe class="map" src="https://www.google.com/maps?q=<?php echo $office?>&output=embed"></iframe>


<?php
Template::footer();