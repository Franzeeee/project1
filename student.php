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
            <nav>
                <h1 class="nav-text"><a>Student</a></h1>
            </nav>

            <!-- List of Students -->
            <table>
                <tr>
                    <th>Student ID</th>
                    <th>Lastname</th>
                    <th>Firstname</th>
                    <th>Action</th>
                </tr>
                <?php
                $pdo = new PDO('mysql:host=localhost; dbname=project1', 'root');
                $stmt = $pdo->query('SELECT * FROM students');
                while ($row = $stmt->fetch()) {
                    echo "<tr>";
                    echo "<td>{$row['student_id']}</td>";
                    echo "<td>{$row['lastname']}</td>";
                    echo "<td>{$row['firstname']}</td>";
                    echo "<td>
                    <button onclick=\"location.href='student_subjects.php?id={$row['id']}'\">
                    <p>View Subject<p>
                </button>
                <button onclick=\"location.href='edit_student.php?id={$row['student_id']}'\">
                    <p>Edit</p>
                </button>
                <button onclick=\"location.href='delete_student.php?id={$row['student_id']}'\">
                    <p>Delete</p>
                </button>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </table>

            <!-- Button to Add Student -->
            <a href="add_student.php" class="add-student-button">Add Student</a>
        </div>
        <!-- Content for Students Page -->

    </div>
</body>

</html>