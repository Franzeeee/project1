<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $student_id = $_GET['id'];

    // Fetch the student's current information from the database
    $pdo = new PDO('mysql:host=localhost;dbname=project1', 'root');
    $stmt = $pdo->prepare('SELECT * FROM students WHERE student_id = ?');
    $stmt->execute([$student_id]);
    $student = $stmt->fetch();

    if ($student) {
        // Display the edit form with the current information
        $student_id = $student['student_id'];
        $lastname = $student['lastname'];
        $firstname = $student['firstname'];
        $id = $student['id'];
    } else {
        echo 'Student not found.';
        // You can add a link to go back to the student list page
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission to update the student's information in the database
    $new_student_id = $_POST['student_id'];
    $new_lastname = $_POST['lastname'];
    $new_firstname = $_POST['firstname'];
    $id = $_POST['id'];

    $pdo = new PDO('mysql:host=localhost; dbname=project1', 'root');
    $stmt = $pdo->prepare('UPDATE students SET student_id = ?, lastname = ?, firstname = ? WHERE id = ?');
    $result = $stmt->execute([$new_student_id, $new_lastname, $new_firstname, $id]);

    if ($result) {
        header('Location: student.php');
        exit();
    } else {
        echo 'Error updating the student.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" type="text/css" href="css/studentpage.css">
    <?php
    include 'sideBar-Style.php';
    ?>
</head>

<body>
    <div class="wrapper d-flex">
        <!-- Sidebar Code -->
        <?php include 'sideBar.php'; ?>
        <!-- Sidebar Code -->
        <!-- Content for Edit Student Page -->
        <div class="content">
            <main>
                <h1>Edit Student</h1>
                <form method="post" action="edit_student.php">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <label for="student_id">Student ID:</label>
                    <input type="text" name="student_id" value="<?= $student_id ?>" required>
                    <label for="lastname">Lastname:</label>
                    <input type="text" id="lastname" name="lastname" value="<?= $lastname ?>" required>
                    <label for="firstname">Firstname:</label>
                    <input type="text" id="firstname" name="firstname" value="<?= $firstname ?>" required>
                    <button type="submit">Save Changes</button>
                </form>
                <main>
        </div>
        <!-- Content for Edit Student Page -->
    </div>
</body>

</html>