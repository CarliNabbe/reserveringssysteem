<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'reservering';

// Stap 1: Verbinding maken met de database
$db = mysqli_connect($host, $username, $password, $database)
or die('Error ' . mysqli_connect_error());