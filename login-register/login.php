<?php
require_once("lFunction.php");
?>

<html <!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div>

    </div>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" style="min-height: 200px">
        <legend id="formChild">LOGIN</legend>
        <?php
        if (empty($username)) {
            $error = '<i style="color: #ff0000c2; font-size: 1em">The username is required.</i>';
            echo $error;
        }

        ?>
        <input id="formChild" placeholder="Username" autocomplete="off" type="text" name="username">
        <input id="formChild" placeholder="Password" type="password" name="password">
        <input id="formChild" value="SIGN IN" type="submit">
        <a id="signUp" href="reg.php">
            <p>Sign Up</p>
        </a>
    </form>

</body>

</html>

<!--This is PHP code-->
<?php





?>