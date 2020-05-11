<?php

if (isset($_POST["submit"])) {
//Require database in this file
    require_once "connect.php";
    require "email.php";

//Postback with the data showed to the user, first retrieve data from 'Super global'
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_escape_string($db, $_POST['lastname']);
    $manyPersons = mysqli_escape_string($db, $_POST['manyPersons']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $phonenumber = mysqli_escape_string($db, $_POST['phonenumber']);
    $extra = mysqli_escape_string($db, $_POST['extra']);

    if (empty($errors)) {
        //Save the record to the database
        $query = "INSERT INTO klanten (firstname, lastname, manyPersons, email, phonenumber, extra)
                  VALUES ('$firstname', '$lastname', '$manyPersons', '$email', '$phonenumber', '$extra')";
        $result = mysqli_query($db, $query)
        or die('Error: ' . $query);
//        if ($result) {
//            header('Location: action_page.php');
//            exit;
//        } else {
//            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
//        }
        //Close connection
        mysqli_close($db);
    }
}


//    mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Action_page</title>
</head>
<body>

<p>Je reservering is gelukt!</p>
<button><a href="index.php">Home</a></button>

</body>
</html>