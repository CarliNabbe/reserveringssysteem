<?php

//Require music data & image helpers to use variable in this file
require_once "connect.php";
//Retrieve the GET parameter from the 'Super global'
$id = $_GET['id'];

//Remove from the database
$query = "DELETE FROM klanten WHERE id = " . mysqli_escape_string($db, $id);
mysqli_query($db, $query) or die ('Error: '.mysqli_error($db));
//Close connection
mysqli_close($db);
//Redirect to homepage after deletion & exit script
header("Location: login_success.php");
exit;



