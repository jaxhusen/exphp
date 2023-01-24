<?php
 $office = "Gran Canaria, youmbo center";
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDb.php";


Template::header("Hitta hit");
?>
<?php

$lat2 = 58.933333;
$long2 = 17.9;

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


if(isset($_POST["submit_coordinates"])){
    $latitude = $_POST["latitude"]; 
    $longitude = $_POST["longitude"];
   var_dump(calculateDistance($latitude, $longitude, $lat2, $long2));  
}

?>


<h2 class="admin-heading"> Long / Lat</h2>
<h4> Avståndet mellan <?=$latitude ?>, <?= $longitude ?> och Youmbo Centre, Gran Canaria är: <?= $distance ?> </h4>
<?php var_dump($distance);  ?>


    <form method="POST">
            <input type="text" name="latitude" placeholder="Skriv in latitude">
            <input type="text" name="longitude" placeholder="Skriv in longitude">
            <input type="submit" name="submit_coordinates">
    </form> 
 <iframe class="map" src="https://www.google.com/maps?q=<?php echo $office?>&output=embed"></iframe>
    <?php

?>







<!-- <iframe class="map" src="https://www.google.com/maps?q=<?php echo $office;?>&output=embed"></iframe>
 -->










 

<?php
Template::footer();
