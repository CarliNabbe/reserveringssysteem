<?php

if (isset($_POST["submit"])) {
    //Require database in this file
    require_once "connect.php";
    require_once "email.php";

    //Postback with the data showed to the user, first retrieve data from 'Super global'
    //Mysqli is used to prevent SQL injections
    $username = mysqli_escape_string($db, $_POST['uname']);
    $password = mysqli_escape_string($db, $_POST['psw']);

    if (empty($errors)) {

        //Password Hash
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        //Save the record to the database
        $query = "INSERT INTO `admin` (`username`, `password`)
                  VALUES ('$username', '$hashed_password')";
        $result = mysqli_query($db, $query)
        or die('Error: '.$query);
        if ($result) {
            header('Location: login.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }
        //Close connection
        mysqli_close($db);
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
    <title>Create admin</title>
    <link rel="stylesheet" type="text/css"  href="css/style_create.css">
</head>
<body>

<div id="navbar" class="sticky">
    <a href="index.php">Maak reservering</a>
</div>

<img src="img/logo.png" alt="" class="logo">


<form action="" method="post">

    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname">

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw">

        <button type="submit" name="submit">Create</button>
    </div>
</form>

</body>
</html>
