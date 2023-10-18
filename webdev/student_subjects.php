<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Subjects</title>
    <link rel="stylesheet" type="text/css" href="css/studentpage.css">
    <?php
    include 'sideBar-Style.php';
    ?>
</head>
<body>
    <div class="wrapper d-flex">
        <!-- Sidebar Code -->
        <?php
        include 'sideBar.php';
        ?>
        <!-- Sidebar Code -->
        <!-- Content for Student Subjects Page -->
        <div class="content">
            <h1>Student Subjects</h1>
            <?php
            if (isset($_GET['id'])) {
                $student_id = $_GET['id'];
                // Replace with your database connection code
                $pdo = new PDO('mysql:host=localhost; dbname=project1', 'root');
                $stmt = $pdo->prepare('SELECT * FROM students WHERE student_id = ?');
                $stmt->execute([$student_id]);
                echo "<table>
                        <tr>
                            <th>Instructor</th>
                            <th>Schedule</th>
                            <th>Room</th>
                            <th>Grade</th>
                        </tr>";
                while ($row = $stmt->fetch()) {
                    echo "<tr>";
                    echo "<td>{$row['instructor']}</td>";
                    echo "<td>{$row['schedule']}</td>";
                    echo "<td>{$row['room']}</td>";
                    echo "<td>{$row['grade']}</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No student ID specified.</p>";
            }
            ?>
        </div>
        <!-- Content for Student Subjects Page -->
    </div>
</body>
</html>
