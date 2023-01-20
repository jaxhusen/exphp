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
            <title> <?= $title ?></title>
        </head>
        <body>
            <header>
                <h1 class="title"> <?= $title ?> </h1>
            </header>


            <ul class="nav">
                    <a href="/">Startsida</a>
                    <div class="dropdown">
                        <a href="/pages/products.php" class="drop-head">Produkter</a>
                        <div class="dropdown-content">
                            <a href="/pages/jsonproducts.php">REA</a>
                        </div>
                    </div>
                    <a href="/pages/cart.php">Varukorg(<?= $cart_count ?>)</a>
                    <?php if($is_logged_in) : ?>
                        <a href="/pages/orders.php"></i>Mina ordrar</a>
                    <?php endif; ?>
                    <?php if (!$is_logged_in) : ?>
                    <div class="dropdown">
                        <a href="/pages/login.php" class="drop-head">Logga in</a>
                        <div class="dropdown-content">
                            <a href="/pages/register.php">Registrera</a>
                        </div>
                    </div>
                    <?php elseif ($is_admin) : ?>
                        <a href="/../pages/admin.php">Admin sida</a>
                    <?php endif; ?> 
                </ul>


            <main>
                <?php if ($is_logged_in) : ?>
                        <form action="/./scripts/post-logout.php" method="post" class="logged-in-box">
                            <input class="logout-btn" type="submit" value="Logga ut: <?= $logged_in_user->username ?>  ">
                        </form>
                        <hr>
                <?php endif; ?>
            </main>


        <?php }



public static function index($title)
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
            <title> <?= $title ?></title>
        </head>
        <body>
        <div class="headerIndex">
                <h1 class="titleIndex"> <?= $title ?> </h1>
            </div>


            <ul class="nav">
                    <a href="/">Startsida</a>
                    <div class="dropdown">
                        <a href="/pages/products.php" class="drop-head">Produkter</a>
                        <div class="dropdown-content">
                            <a href="/pages/jsonproducts.php">REA</a>
                        </div>
                    </div>
                    <a href="/pages/cart.php">Varukorg(<?= $cart_count ?>)</a>
                    <?php if($is_logged_in) : ?>
                        <a href="/pages/orders.php"></i>Mina ordrar</a>
                    <?php endif; ?>
                    <?php if (!$is_logged_in) : ?>
                    <div class="dropdown">
                        <a href="/pages/login.php" class="drop-head">Logga in</a>
                        <div class="dropdown-content">
                            <a href="/pages/register.php">Registrera</a>
                        </div>
                    </div>
                    <?php elseif ($is_admin) : ?>
                        <a href="/../pages/admin.php">Admin sida</a>
                    <?php endif; ?> 
                </ul>


            <main>
                <?php if ($is_logged_in) : ?>
                        <form action="/./scripts/post-logout.php" method="post" class="logged-in-box">
                            <input class="logout-btn" type="submit" value="Logga ut: <?= $logged_in_user->username ?>  ">
                        </form>
                <?php endif; ?>
            </main>


        <?php }



    public static function footer()
    {
        ?>
            <footer class="footer">
                <div class="footer-one">
                    <div class="div-headern"> Arthusen </div>
                    <a href="#"> Produkter </a>
                    <a href="#"> Rea </a>
                </div>
                <div class="footer-one">
                    <div class="div-headern"> Kontakt </div>
                    <a href="#">Kontakta oss</a>
                    <a href="#">Vanliga frågor</a>
                    <a href="#">Om oss</a>
                </div>

                <div class="footer-one">
                    <div class="div-headern"> Villkor </div>
                    <a href="#">Villkor</a>
                    <a href="#">Copyright</a>
                </div>
                <div class="footer-two">
                <p> Copyright ARThusen 2020 </p>
                <a href="mailto:#">kontakta-oss@arthusen.com</a>
                <div class="adress">
                    <p>Youmbo Center 26</p>
                    <p>Playa del Ingles, 12345</p>
                    <p>Gran Canaria</p>
                </div>
                </div>
            </footer>

        </body>
        </html>
<?php }
}