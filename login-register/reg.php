<?php require_once("database_connector.php"); ?>

<html <!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register Account</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <form action="reg.php" method="POST">
            <legend>SIGN UP</legend>
            <input type="text" autocomplete="off" placeholder="Firstname" name="firstname">
            <input type="text" autocomplete="off" placeholder="Lastname" name="lastname">
            <input type="text" autocomplete="off" placeholder="Email" name="email">
            <input type="text" autocomplete="off" placeholder="Username" name="username">
            <input type="password" placeholder="Password" autocomplete="off" name="password">
            <input type="submit" value="Register">
            <a id="signUp" href="login.php">
                <p>LOGIN</p>
            </a>
        </form>
    </div>
</body>

</html>

<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = trim($_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if (empty($firstname)) {
        echo "<script>alert('Please enter a firstname.')</script>";
    } else if (empty($lastname)) {
        echo "<script>alert('Please Enter a lastname')</script>";
    } else if (empty($username)) {
        echo "<script>alert('Please enter an username.')</script>";
    } else if (empty($email)) {
        echo "<script>alert('Please enter an email.')</script>";
    } else if (empty($password)) {
        echo "<script>alert('Please Enter a password')</script>";
    } else {

        $sql = "INSERT INTO user_profile (`firstname`, `lastname`, `email`, `username`, `password`) VALUES ('$firstname', '$lastname', '$email', '$username', '$hashedPassword')";


        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('User registered successfully.');</script>";
            echo "<script> window.location.href='login.php'</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
}

?>