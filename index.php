<?php
$office = "Gran Canaria, youmbo center"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./assets/snowflake.js"></script> 
    <title>ARThusen</title>
</head>
<body>

<?php // http://localhost:8888/
require_once __DIR__ . "/classes/Template.php";

session_start();
$is_logged_in = isset($_SESSION['user']);
$logged_in_user = $is_logged_in ? $_SESSION['user'] : null;

Template::index('ARThusen_');
 

?>
    <div>
        <div class="h1-header">
            <i>'The earth without art is just eh'</i>
        </div>
    </div>


    <div class="text-startsida">
        <h1 class="h1-startsida">ARThusen_</h1>
        <p class="p-text-startsida"><b>Vad är ARThusen_?</b><i> Lorem Ipsum is simply dummy text of the
            printing and typesetting industry. Lorem Ipsum has been the industry's
            standard dummy text ever since the 1500s, when an unknown printer took
            a galley of type and scrambled it to make a type specimen book. It has 
            survived not only five centuries, but also the leap into electronic 
            typesetting, remaining essentially unchanged.</i></p></br>
            <p class="p-textunder-startsida">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Scelerisque fermentum dui faucibus in ornare. Ipsum consequat nisl vel pretium lectus quam id leo. Amet mauris commodo quis imperdiet massa tincidunt nunc. Sed faucibus turpis in eu. Fermentum leo vel orci porta non. Sem fringilla ut morbi tincidunt augue. Mattis aliquam faucibus purus in massa tempor nec feugiat nisl. Egestas congue quisque egestas diam in. Amet venenatis urna cursus eget nunc scelerisque viverra. Et netus et malesuada fames. Tempor orci dapibus ultrices in iaculis nunc. Nunc faucibus a pellentesque sit amet. Eu lobortis elementum nibh tellus molestie nunc non blandit.
            Pretium fusce id velit ut tortor. Dictumst quisque sagittis purus sit amet volutpat consequat mauris nunc. Pretium vulputate sapien nec sagittis aliquam malesuada. Imperdiet massa tincidunt nunc pulvinar sapien et. Mi quis hendrerit dolor magna eget est lorem. Et tortor consequat id porta nibh venenatis. Odio aenean sed adipiscing diam donec adipiscing. Ultricies integer quis auctor elit sed vulputate mi sit. Morbi tincidunt ornare massa eget egestas. Vestibulum rhoncus est pellentesque elit ullamcorper. Egestas maecenas pharetra convallis posuere morbi leo urna molestie. Urna et pharetra pharetra massa massa ultricies.
            Magna fringilla urna porttitor rhoncus. Velit laoreet id donec ultrices tincidunt arcu non. Arcu cursus euismod quis viverra nibh cras pulvinar mattis. Morbi tincidunt augue interdum velit. Vitae suscipit tellus mauris a diam maecenas. Mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus et netus. Velit egestas dui id ornare arcu odio. Nunc sed blandit libero volutpat sed cras. Tempus urna et pharetra pharetra massa massa. Suspendisse sed nisi lacus sed. Et tortor consequat id porta nibh venenatis. Dignissim diam quis enim lobortis scelerisque fermentum. Eget est lorem ipsum dolor sit.
            </p>
    </div>


    <div class="startsida-container">
        <div class="startsida-box-2">
            <a href="/../pages/jsonproducts.php" class="img-startsida">[ REA ]</a>
        </div>
        <div class="startsida-box">
            <a href="/../pages/products.php" class="img-startsida"><p class="img-startsida-inlinetext">[ Produkter ]</p></a>
        </div>
    </div>


    <div class="startsida-banner">Kontakta oss</div>
        <p class="p-text-startsida" style="margin-bottom:2%;color: var(--color-heading)"><b>Har du något på hjärtat? </b> Tveka inte på att höra av dig. Vi finns här för dig. Som en hjälpande hand, partner in crimer eller vill du helt enkelt bara diskutera konst?
            Vi ser fram emot att höra från dig. Återkopplar sker oftast inom 3-6 arbetsdagar då vi har högt tryck under vinter halvåret. Är ditt ärende akut? Ring gärna vår kundtjänst på <b> 070-000 00 00</b>. 
            Vill du inte mejla? Du är välkommen att kika förbi vårt kontor i Youmbo Center mitt i soliga Playa del Ingles på Gran Canaria. Kom in och ta en pause från vardagen, fika står vi för! Välkommen.
        </p></br>

<?php
if ($is_logged_in) : ?>
<div class="div-space-between">
        <form class="form-contaus" action="/scripts/post-contactus.php" method="post" enctype="multipart/form-data">
            <h4 class="h4-pad" style="color: var(--color-heading);font-size: larger;">Kontakta oss här:</h4>
            </br>
            <input class="form-input" type="name" name="name" placeholder="Namn">
            <textarea class="form-input" name="textarea" placeholder="Textarea"  style="margin-top: 2%"></textarea>
            <div class="form-btns" style="margin-top: 2%">
                <input class="user-regitration" type="submit" value="Skicka">
            </div>
        </form> 
    <div class="del-50">
        <iframe class="map" src="https://www.google.com/maps?q=<?php echo $office;?>&output=embed"></iframe>
    </div>
</div>
<?php else: ?>
    <?php if (!$is_logged_in) : ?>

        <div class="div-space-between">
        <form class="form-contaus" action="/scripts/post-contactus.php" method="post" enctype="multipart/form-data">
        <div class="empty-cart"style="padding-top: 0%; height: 70px;">
        <a class="link-oops" href="/pages/login.php"></i>Logga in för att skicka meddelande</a>
        </div></br>
            <input class="form-input disabled" type="name" name="name" placeholder="Namn">
            <textarea class="form-input disabled" name="textarea" placeholder="Textarea"  style="margin-top: 2%"></textarea>
            <div class="form-btns disabled" style="margin-top: 2%">
                <input class="user-disabled" type="submit" value="Skicka">
            </div>
        </form> 
    <div class="del-50">
        <iframe class="map" src="https://www.google.com/maps?q=<?php echo $office;?>&output=embed"></iframe>
    </div>
</div>


    <?php endif ; ?> 
    <?php endif ; ?>
</body>
</html>

<?php

Template::footer();