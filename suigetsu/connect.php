<?php
$servername = "localhost"; // must be localhost
$username = "root"; //must be root
$password = ""; // leave empty
$db = "suigetsu"; // the database's name

// Create connection
$con = mysqli_connect($servername, $username, $password, $db);

// Check connection: procedural
if (!$con) {
    die("Connection failed: " . mysqli_connect_error()); // terminate conn & display the error message
}
?>