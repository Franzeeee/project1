<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location: login-register/login.php');
}
