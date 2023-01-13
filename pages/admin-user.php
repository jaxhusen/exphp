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
<form class="row" action="/admin-scripts/post-update-user.php?username=<?= $_GET["username"]?>" method="post">
<select name="role">
        <option disabled selected>Roll</option>
        <option value="admin">Admin</option>
        <option value="customer">Kund</option>
    </select>
    <input class="user-regitration" type="submit" value="Spara">
</form>
</div>
<div class="one">
<h4 class="admin-sub-heading">Radera "<?= $_GET["username"] ?>"</h2>
    <form action="/admin-scripts/post-delete-user.php" method="post">
        <input type="hidden" name="username" value="<?= $_GET["username"] ?>">
        <input class="user-regitration" type="submit" value="Radera användare">
    </form>
    </div>
    </div>
</div>
<?php




Template::footer();
?>