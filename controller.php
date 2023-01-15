<?php
require_once './config.php'; 
require_once './vendor/autoload.php'; 


//authentizise code from oauth google
if(isset($_GET['code'])){
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $userinfo = [
        'email' => $google_account_info['email'],
        'full_name' => $google_account_info['name'],
        'picture' => $google_account_info['picture'],
        'verifiedEmail' => $google_account_info['verifiedEmail'],
        'token' => $google_account_info['id']
    ];



    // checking iif user exists in db
    $sql = "SELECT * FROM `google-login` WHERE email = '{$userinfo['email']}'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        //user exists
        $userinfo = mysqli_fetch_assoc($result);
        $token = $userinfo['token'];
    }else{
        // user dont exists
        $sql = "INSERT INTO `google-login` (email, full_name, picture, verifiedEmail, token) 
        VALUES ('{$userinfo['email']}',
                '{$userinfo['name']}',
                '{$userinfo['picture']}', 
                '{$userinfo['verifiedEmail']}',
                '{$userinfo['token']}')";
        $result = mysqli_query($query, $sql);
        if($result){
            echo "user is created";
            $token = $userinfo['token'];
        }else{
           echo "user is not created ERROOOORRRR";
           die();
        }
    }

    //save user into session
    $_SESSION['user_token'] = $token;
}else{
        // checking iif user exists in db
        $sql = "SELECT * FROM `google-login` WHERE token = '{$_SESSION['user_token']}'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            //user exists
            $userinfo = mysqli_fetch_assoc($result);
        }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controller</title>
</head>
<body>
    <img src="<?= $userinfo['picture'] ?>" alt="" width="90px" height="90px">
    <ul>
        <li> Full name: <?= $userinfo['full_name'] ?></li>
        <li> Email: <?= $userinfo['email'] ?></li>
        <li> var_dump<?= var_dump($userinfo) ?></li>
    </ul>

</body>
</html>