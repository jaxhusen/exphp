<?php
require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDb.php";


$user_db = new UsersDb();
$user = $user_db->get_one_by_username($_GET["username"]);

Template ::header("Admin-user");
?>



<div class="admin-update">
<div class="admin-update-box">
    <div class="one">
<h4 class="admin-sub-heading">Uppdatera <?= $_GET["username"] ?></h4>
<form action="/admin-scripts/post-update-user.php?username=<?= $_GET["username"]?>" method="post" class="row" >
<select name="role">
        <option disabled selected>Roll</option>
        <option value="admin">Admin</option>
        <option value="customer">Kund</option>
    </select>
    <input type="submit" value="Spara" class="user-regitration">
</form>
</div>
<div class="one">
<h4 class="admin-sub-heading">Radera "<?= $_GET["username"] ?>"</h2>
    <form action="/admin-scripts/post-delete-user.php" method="post">
        <input type="hidden" name="username" value="<?= $_GET["username"] ?>">
        <input type="submit" value="Radera användare" class="user-regitration">
    </form>
    </div>
    </div>
</div>
<?php




Template::footer();
?>