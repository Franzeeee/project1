<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $student_id = str_pad(mt_rand(1, 9999999), 7, '0', STR_PAD_LEFT);

    // Perform database connection and insertion here
    $pdo = new PDO('mysql:host=localhost;dbname=project1', 'root');
    $stmt = $pdo->prepare('INSERT INTO students (lastname, firstname, student_id) VALUES (?, ?, ?)');
    $result = $stmt->execute([$lastname, $firstname, $student_id]);

    if ($result) {
        header('Location: student.php'); // Redirect to the student list page
        exit();
    } else {
        echo 'Error adding the student.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/studentpage.css">
    <title>Add Student</title>
    <?php include 'sideBar-Style.php'; ?>
</head>

<body>
    <div class="wrapper d-flex">
        <!-- Sidebar Code -->
        <?php include 'sideBar.php'; ?>
        <!-- Sidebar Code -->
        <!-- Content for Add Student Page -->
        <div class="content">
            <form method="post">
                <legend>Add Student</legend>
                <label for="lastname">Lastname:</label>
                <input type="text" id="lastname" name="lastname" required>
                <label for="firstname">Firstname:</label>
                <input type="text" id="firstname" name="firstname" required>
                <button type="submit">Add Student</button>
                <div class="cancel" onclick="window.history.back()">Cancel</div>
            </form>

        </div>
        <!-- Content for Add Student Page -->
    </div>
</body>

</html>