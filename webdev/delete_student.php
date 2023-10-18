<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $student_id = $_GET['id'];
    
    // Fetch the student's information for confirmation
    $pdo = new PDO('mysql:host=localhost;dbname=project1', 'root');
    $stmt = $pdo->prepare('SELECT * FROM students WHERE student_id = ?');
    $stmt->execute([$student_id]);
    $student = $stmt->fetch();
    
    if ($student) {
        // Display the student's information and a confirmation form
        $lastname = $student['lastname'];
        $firstname = $student['firstname'];
        $student_id = $student['student_id'];
    } else {
        echo 'Student not found.';
        // You can add a link to go back to the student list page
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission to delete the student from the database
    $student_id = $_POST['student_id'];
    
    $pdo = new PDO('mysql:host=localhost; dbname=project1', 'root');
    $stmt = $pdo->prepare('DELETE FROM students WHERE student_id = ?');
    $result = $stmt->execute([$student_id]);
    
    if ($result) {
        header('Location: student.php');
        exit();
    } else {
        echo 'Error deleting the student.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
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
        <!-- Content for Delete Student Page -->
    <div class="content">
        <h1>Delete Student</h1>
        <p>Are you sure you want to delete this student?</p>
            <form method="post" action="delete_student.php">
            <input type="hidden" name="student_id" value="<?= $student_id ?>">
            <button type="submit">Delete</button>
            <button><a href="student.php">Cancel and Back to Student List</a></button>
        </form>
            
    </div>
    <!-- Content for Delete Student Page -->
</body>
</html> 
