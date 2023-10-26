<?php
require_once("database_connector.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $find = $conn->query("SELECT * FROM `user_profile` WHERE email = '$email'");

    if ($find->num_rows > 0) {
        $data = $find->fetch_array();

        if (password_verify($password, $data['password'])) {
            $_SESSION['name'] = $data['firstname'] . " " . $data['lastname'];

            header("Location: ../subject.php");
        } else {
            echo "<script> alert('Email/Password is incorrect!');</script>";
        }
    } else if (!empty($email)) {
        echo "<script> alert('Email/Password is incorrect!');</script>";
    }
}
