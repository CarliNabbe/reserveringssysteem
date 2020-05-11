<?php
//Require database in this file
require_once "connect.php";

$id = $_GET['index'];

if (isset($_POST['submit'])){


    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $firstname = mysqli_escape_string($db, $_POST['firstname']);
    $lastname   = mysqli_escape_string($db, $_POST['lastname']);
    $manyPersons  = mysqli_escape_string($db, $_POST['manyPersons']);
    $email   = mysqli_escape_string($db, $_POST['email']);
    $phonenumber = mysqli_escape_string($db, $_POST['phonenumber']);
    $extra = mysqli_escape_string($db, $_POST['extra']);
    $id = $_POST['id'];

    //Save variables to array so the form won't break
    //This array is build the same way as the db result
    $reservering = [
        'firstname'    => $firstname,
        'lastname'      => $lastname,
        'manyPersons'     => $manyPersons,
        'email'      => $email,
        'phonenumber'    => $phonenumber,
        'extra'     => $extra,
    ];


    //Update the record in the database
    $query = "UPDATE klanten
                  SET firstname = '$firstname', lastname = '$lastname', manyPersons = '$manyPersons', email = '$email', phonenumber = '$phonenumber', extra = '$extra'
                  WHERE id = '$id'";
    $result = mysqli_query($db, $query);
    if ($result) {
        header('Location: login_success.php');
        exit;
    } else {
        $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
    }
}

else if (isset($_GET['index'])){

    $query = "SELECT * FROM klanten WHERE id = $id";
    $result = mysqli_query($db, $query)
    or die('Error: '.$query);


    $klant = mysqli_fetch_assoc($result);

}



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update</title>
    <link rel="stylesheet" type="text/css"  href="css/style_update.css">
</head>
<body>

<div id="navbar" class="sticky">
    <a href="login.php">Login</a>
</div>

<header>

    <div id="cnr-header">
        <div id="logo"><img src="img/logo.png" alt="logo" /></div>
    </div>

</header>

<h1>Update de reservering</h1>


<!--Register formulier-->
<div id="cnr-form">

    <form action="" method="post">
        <div class="container">
            <label for="firstname" id="firstname"><b>Voornaam</b></label>
            <input type="text" name="firstname" required value="<?= $klant['firstname']; ?>">

            <label for="lastname" id="lastname"><b>Achternaam</b></label>
            <input type="text"name="lastname" required value="<?= $klant['lastname']; ?>">

            <label for="manyPersons"><b>Aantal Personen</b></label>
            <input type="number" name="manyPersons" required value="<?= $klant['manyPersons']; ?>">

            <label for="email"><b>Email</b></label>
            <input type="email" name="email" required value="<?= $klant['email']; ?>">

            <label for="phonenumber"><b>Telefoonnummer</b></label>
            <input type="tel" maxlength="10" minlength="10" name="phonenumber" value="<?= $klant['phonenumber']; ?>">

            <label for="extra"><b>Extra opmerkingen</b></label>
            <textarea name="extra"></textarea>
            <hr>

            <input type="hidden" name="id" value="<?= $id; ?>"/>
            <button type="submit" class="registerbtn" name="submit">Verstuur</button>
        </div>
    </form>

</body>
</html>
