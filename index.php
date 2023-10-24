<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: subject.php');
} else {
    echo 'LOGIN!';
}
