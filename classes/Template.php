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
            <script src="https://kit.fontawesome.com/b5e1c569b8.js" crossorigin="anonymous"></script>
            <script src="/../assets/burgermeny.js"></script>
            <title> <?= $title ?></title>
        </head>
        <body>
            <header>
                <h1 class="title"> <?= $title ?> </h1>
            </header>

            <ul class="nav">
                    <div class="dropdown">
                        <a href="/" class="drop-head">Startsida</a>
                        <div class="dropdown-content">
                            <a href="/pages/message.php">Kontakta oss</a>
                            <a href="/pages/about-us.php">Om oss</a>
                            <a href="/pages/find-us.php">Hitta hit</a>
                            <a href="/pages/qanda.php">Vanliga frågor</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="/pages/products.php" class="drop-head">Produkter</a>
                        <div class="dropdown-content">
                            <a href="/pages/jsonproducts.php">REA</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="/pages/cart.php" class="drop-head">Varukorg</a>
                    </div>
                    <?php if($is_logged_in) : ?>
                    <div class="dropdown">
                        <a href="/pages/my-account.php" class="drop-head">Mitt konto</a>
                        <div class="dropdown-content">
                            <a href="/pages/orders.php">Mina ordrar</a>
                        </div>
                    </div>
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
<!--             <script src="https://kit.fontawesome.com/b5e1c569b8.js" crossorigin="anonymous"></script> -->
            <title> <?= $title ?></title>
        </head>
        <body>
        <div class="headerIndex">
                <h1 class="titleIndex"> <?= $title ?> </h1>
            </div>

            <ul class="nav">
                    <div class="dropdown">
                        <a href="/" class="drop-head">Startsida</a>
                        <div class="dropdown-content">
                            <a href="/pages/message.php">Kontakta oss</a>
                            <a href="/pages/about-us.php">Om oss</a>
                            <a href="/pages/find-us.php">Hitta hit</a>
                            <a href="/pages/qanda.php">Vanliga frågor</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="/pages/products.php" class="drop-head">Produkter</a>
                        <div class="dropdown-content">
                            <a href="/pages/jsonproducts.php">REA</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="/pages/cart.php" class="drop-head">Varukorg</a>
                    </div>
                    <?php if($is_logged_in) : ?>
                    <div class="dropdown">
                        <a href="/pages/my-account.php" class="drop-head">Mitt konto</a>
                        <div class="dropdown-content">
                            <a href="/pages/orders.php">Mina ordrar</a>
                        </div>
                    </div>
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
                    <a href="./pages/message.php">Kontakta oss</a>
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