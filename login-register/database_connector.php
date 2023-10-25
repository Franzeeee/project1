<?php

$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "project1";

$conn = mysqli_connect($serverName, $username, $password, $dbName, 4306);

// Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
?>