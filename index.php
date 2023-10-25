<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: login-register\login.php');
} else {
    echo 'LOGIN!';
}
