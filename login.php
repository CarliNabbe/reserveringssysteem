<?php
//Start session
session_start();
//Stap 1: Haal de database op
require_once 'connect.php';

$error = '';

// ALS de data verstuurd?
if (isset($_POST['submit']))
{

    // data uit het formulier ophalen
    // specialchars tegen beveiligen van xss
    $username = htmlspecialchars($_POST['uname']);
    $password = htmlspecialchars($_POST['psw']);

    // Query

    $pass = mysqli_query($db, "SELECT password FROM admin WHERE username = '$username'");

    $hash = mysqli_fetch_assoc($pass);
    // print_r($hash);
    // die();

    //Validatie
        if(password_verify($password, $hash['password'])) {

            $_SESSION['login_user']= $username;
            
            // header('Location: login_success.php');
            $error = 'Je bent nu ingelogd!';

        }
        else{
            $error = 'Gegevens niet juist';
        }
    
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login page</title>
    <link rel="stylesheet" type="text/css"  href="css/style_login.css">
</head>
<body>

<div id="navbar" class="sticky">
    <a href="index.php">Maak reservering</a>
</div>

<img src="img/logo.png" alt="" class="logo">

<form action="" method="post">
    <div class="container">
        <p><?= $error ?></p>
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname">

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw">

        <button type="submit" name="submit">Login</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
        <span class="psw"><a href="create.php">Create admin</a></span><br><br>
        <span class="psw"><a href="login_success.php">Bekijk adminpanel</a></span>
    </div>
</form>

</body>
</html>