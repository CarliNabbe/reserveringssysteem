<?php

require "weather.php";

  // define error variables and set to empty values
  $firstnameErr = $lastnameErr = $manyPersonsErr = $emailErr = "";


if (isset($_POST["submit"])) {
    // Require database in this file
    require_once "connect.php";
    require "email.php";
    

    // Postback with the data showed to the user, first retrieve data from 'Super global'
    $firstname = mysqli_escape_string($db, $_POST['firstname']);
    $lastname   = mysqli_escape_string($db, $_POST['lastname']);
    $manyPersons  = mysqli_escape_string($db, $_POST['manyPersons']);
    $email   = mysqli_escape_string($db, $_POST['email']);
    $phonenumber = mysqli_escape_string($db, $_POST['phonenumber']);
    $extra = mysqli_escape_string($db, $_POST['extra']);
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["firstname"])) {
            $firstnameErr = "Voornaam is verplicht";
        }

        if(empty($_POST["lastname"])) {
            $lastnameErr = "Achternaam is verplicht";
        }

        if(empty($_POST["manyPersons"])) {
            $manyPersonsErr = "Aantal is verplicht";
        }

        if(empty($_POST["email"])) {
            $emailErr = "Email is verplicht";
        }
    }
    if($firstname && $lastname && $manyPersons && $email) {
        $query = "INSERT INTO klanten (firstname, lastname, manyPersons, email, phonenumber, extra)
                VALUES ('$firstname', '$lastname', '$manyPersons', '$email', '$phonenumber', '$extra')";
        $result = mysqli_query($db, $query)
        or die('Error: '.$query);
        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }
    }   
    // Close connection
    mysqli_close($db);    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reserveringssysteem</title>

    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script src="js/googlemap.js"
  type="text/javascript" charset="utf-8"></script>
  
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

<h1>Meld je hier aan voor het diner</h1>


<!--Register formulier-->
<div id="cnr-form">

    <form action="" method="post">
        <div class="container">
            <p style="color: red"><?= $firstnameErr ?></p>
            <label for="firstname" id="firstname"><b>Voornaam</b></label>
            <input type="text" placeholder="Voer je voornaam in" name="firstname">

            <p style="color: red"><?= $lastnameErr ?></p>
            <label for="lastname" id="lastname"><b>Achternaam</b></label>
            <input type="text" placeholder="Voer je achternaam in" name="lastname">

            <p style="color: red"><?= $manyPersonsErr ?></p>
            <label for="manyPersons"><b>Aantal Personen</b></label>
            <input type="number" placeholder="Voer aantal in" name="manyPersons">

            <p style="color: red"><?= $emailErr ?></p>
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Voer email in" name="email">

            <label for="phonenumber"><b>Telefoonnummer</b></label>
            <input type="tel" maxlength="10" minlength="10" placeholder="Voer telefoonnummer in" name="phonenumber">

            <label for="extra"><b>Extra opmerkingen</b></label>
            <textarea placeholder="Extra opmerkingen" name="extra"></textarea>
            <hr>

            <button type="submit" class="registerbtn" name="submit">Verstuur</button>
        </div>
    </form>

</div>


<!--Menu van de week---------------->

<!-- Photo Grid -->
<div id="cnr-menu">

    <div class="mainCourse" style="background-image: url('img/mainCourse.jpg');"></div>
    <div class="firstCourse" style="background-image: url('img/firstCourse.jpg');"></div>
    <div class="dessert" style="background-image: url('img/dessert.jpg');"></div>

</div>


<div id="cnr-footer">
    <!--<img src="img/logo.png" alt="logo" />-->
</div>
<div style="width: 640px; height: 480px" id="map"></div>

</script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiY2rQApAirFxH1XdBktn_q1EfK4Syaj8&callback=initMap">
    </script>

</body>
</html>