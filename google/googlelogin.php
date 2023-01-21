<?php

require_once __DIR__ . '/../classes/UsersDb.php';
require_once __DIR__ . '/../classes/User.php';

//Include Google Configuration File
require_once __DIR__ . ('/../google/googleconfig.php');
/* if($_SESSION['access_token'] == '') {
header("Location: googleindex.php");
}  */
//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received

if(isset($_GET["code"]))
{
    echo "heeej";
    var_dump($google_client);

//It will Attempt to exchange a code for an valid authentication token.
$token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


//This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
if(!isset($token['error']))
{
//Set the access token used for requests
$google_client->setAccessToken($token['access_token']);
//Store "access_token" value in $_SESSION variable for future use.
$_SESSION['access_token'] = $token['access_token'];
//Create Object of Google Service OAuth 2 class
$google_service = new Google_Service_Oauth2($google_client);
//Get user profile data from google
$data = $google_service->userinfo->get();
//Below you can find Get profile data and store into $_SESSION variable
if (!empty($data['email'])) {
    $_SESSION['user_email_address'] = $data['email'];
}
if (!empty($data['picture'])) {
    $_SESSION['user_image'] = $data['picture'];
}
$user = new User($data['email'], $role);

$db = new UsersDb();

$user->id = $db->get_google_userid($user);
$user = $db->get_one_by_username($user->username);

var_dump($user);

$_SESSION["logged_in"] = true;

$_SESSION["user"] = $user;


header("Location: /");
die();
}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP Login using Google Account</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                You have Successfully Logged In With Google
            </div>
            <div class="card-body">
                <p class="card-text">Email:- <?php echo $_SESSION['user_email_address']; ?> </p>
                <img class="user-image" src="<?php echo $_SESSION["user_image"]; ?>" alt="Card image cap">
                <a href="./googlelogout.php" class="btn btn-primary">Logout</a>
                <a href="/index.php">Home</a>
            </div>
        </div>
    </div>
</body>
</html>