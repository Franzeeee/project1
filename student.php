<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Page</title>
    <link rel="stylesheet" type="text/css" href="css/studentpage.css">
    <?php include 'sideBar-Style.php'; ?>
</head>

<body>
    <div class="wrapper d-flex">
        <!-- Sidebar Code -->
        <?php include 'sideBar.php'; ?>
        <!-- Sidebar Code -->
        <!-- Content for Students Page -->
        <div class="content">
            <h1>Students Page</h1>

            <!-- List of Students -->
            <table class="table">
                <thead>
                <tr>
                    <th>Lastname</th>
                    <th>Firstname</th>
                    <th>Student ID</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody class="table-group-divider container">
                <?php
                $pdo = new PDO('mysql:host=localhost; dbname=project1', 'root');
                $stmt = $pdo->query('SELECT * FROM students');
                while ($row = $stmt->fetch()) {
                    echo "<tr>";
                    echo "<td>{$row['lastname']}</td>";
                    echo "<td>{$row['firstname']}</td>";
                    echo "<td>{$row['student_id']}</td>";
                    echo "<td>
                            <button class='btn btn-primary'><a style='color:white' href='student_subjects.php?id={$row['id']}'>View Subjects</a></button>
                            <button class='btn btn-success'><a style='color:white' href='edit_student.php?id={$row['student_id']}'>Edit</a></button>
                            <button class='btn btn-danger'><a style='color:white' href='delete_student.php?id={$row['student_id']}'>Delete</a></button>
                          </td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>

            <!-- Button to Add Student -->
            <a href="add_student.php" class="add-student-button">Add Student</a>
        </div>
        <!-- Content for Students Page -->

    </div>
</body>

</html>
