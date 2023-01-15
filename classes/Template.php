<?php
require_once __DIR__ . "./User.php";
session_start();


class Template
{
    public static function header($title)
    {
        $is_logged_in = isset($_SESSION["user"]);
        $logged_in_user = $is_logged_in ? $_SESSION["user"] : null;
        $is_admin = $is_logged_in && ($logged_in_user->role == "admin");
        $cart_count = isset($_SESSION["cart"]) ? count($_SESSION["cart"]) : 0;
?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="/./assets/style.css">
            <title> <?= $title ?> - Startsida </title>
        </head>
        <body>
            <header>
                <h1 class="title"> <?= $title ?> </h1>
            </header>
            <nav class="nav">
                <a href="/">Startsida</a>
                <a href="/pages/products.php">Produkter</a>
                <a href="/pages/jsonproducts.php">json produkter</a>
                <a href="/pages/cart.php">Varukorg(<?= $cart_count ?>)</a>
                <?php if($is_logged_in) : ?>
                    <a href="/pages/orders.php"></i>Mina ordrar</a>
                <?php endif; ?>
                <?php if (!$is_logged_in) : ?>
                    <a href="/pages/login.php">Logga in</a>
                    <a href="/pages/register.php">Registrera</a>
                <?php elseif ($is_admin) : ?>
                    <a href="/../pages/admin.php">Admin sida</a>
                <?php endif; ?>
            </nav>


            <main>
                <?php if ($is_logged_in) : ?>
                    <p class="logged-in-box">
                        <b>Inloggad som: </b>
                        <?= $logged_in_user->username ?>
                    <form action="/./scripts/post-logout.php" method="post">
                        <input class="logout-btn" type="submit" value="Logout">
                    </form>
                    </p>
                <?php endif; ?>
            </main>


        <?php }
    public static function footer()
    {
        ?>
            <footer class="footer">
                Copyright ARThusen 2020
            </footer>

            <script src="/../assets/script.js"></script>
        </body>
        </html>
<?php }
}