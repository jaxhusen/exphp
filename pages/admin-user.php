<?php

require_once __DIR__ . "/../classes/Template.php";
require_once __DIR__ . "/../classes/UsersDatabase.php";


$user_db = new UsersDatabase();
$user = $user_db->get_one_by_username($_GET["username"]);

Template ::header("Admin-user");
?>


<h2>Update user</h2>


<form action="/admin-scripts/post-update-user.php?username=<?= $_GET["username"] ?>" method="post">

    <select name="role">
        <option disabled selected>Role</option>
        <option value="admin">Admin</option>
        <option value="customer">Customer</option>
    </select><br>
    <input type="submit" value="Save"><br>



</form><br>


    <p><b>Delete: </b></p>


    <form action="/admin-scripts/post-delete-user.php" method="post">
        <input type="hidden" name="username" value="<?= $_GET["username"] ?>">
        <input type="submit" value="Delete user">
    </form>
<?php



Template::footer();