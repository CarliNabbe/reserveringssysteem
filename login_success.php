<?php
// set the default timezone to use. Available since PHP 5.1
date_default_timezone_set('UTC');
session_start();

//Require database in this file
require_once "connect.php";

$admin = "SELECT * from admins";



$query = "SELECT * from klanten";

$result = mysqli_query($db, $query)
    or die(mysqli_error($db));

    $adminResult = mysqli_query($db, $query)
    or die(mysqli_error($db));

$reserveringen = [];
while($row = mysqli_fetch_assoc($result)) {
    $reserveringen[] = $row;
}

if ( isset( $_SESSION['login_user'] ) ) {
    // Let them access the "logged in only" pages
    // header("Location: login_success.php");
} else {
    // Redirect them to the login page
    header("Location: index.php");
}

mysqli_close($db);



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin page</title>
    <link rel="stylesheet" type="text/css"  href="css/style_login_success.css">
</head>
<body>

<div id="navbar" class="sticky">
    <a href="index.php">Maak reservering</a>
</div>

<img src="img/logo.png" alt="" class="logo">
<h1>Welkom op de loginpagina!<br></h1>



<table>
    <thead>
    <tr>
        <th>Voornaam</th>
        <th>Achternaam</th>
        <th id="manyPersonsHead">Hoeveel personen</th>
        <th>Email</th>
        <th>Telefoonnummer</th>
        <th id="extraHead">Extra opmerkingen</th>
        <th>Verander reservering</th>
        <th>Verwijder</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($reserveringen as $reservering) { ?>
        <tr>
            <td id="firstname"><?= $reservering['firstname']; ?></td>
            <td id="lastname"><?= $reservering['lastname']; ?></td>
            <td id="manyPersons"><?= $reservering['manyPersons']; ?></td>
            <td id="email"><?= $reservering['email']; ?></td>
            <td id="phonenumber"><?= $reservering['phonenumber']; ?></td>
            <td id="extra"><?= $reservering['extra']; ?></td>
            <td><a href="update.php?index=<?= $reservering['id']; ?>">Update</a></td>
            <td><a href="delete.php?id=<?= $reservering['id']; ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>


</body>
</html>
