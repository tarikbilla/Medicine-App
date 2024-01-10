<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "medicine_app";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// include funcitons file
include "functions.php";