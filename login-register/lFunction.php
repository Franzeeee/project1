<?php
require_once("database_connector.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $find = $conn->query("SELECT * FROM `user_profile` WHERE username = '$username'");

    if ($find->num_rows > 0) {
        $data = $find->fetch_array();

        if (password_verify($password, $data['password'])) {
            $_SESSION['username'] = $username;

            header("Location: ../subject.php");
        } else {
            echo "<script> alert('Password is incorrect!');</script>";
        }
    } else if (!empty($username)) {
        echo "<script> alert('Username does not exist in our database!');</script>";
    }
}
