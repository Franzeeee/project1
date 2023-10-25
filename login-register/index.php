<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:login.php');
}
?>

<!-- HTML code -->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    <a href="logoutFunction.php">Logout</a>
</body>

</html>