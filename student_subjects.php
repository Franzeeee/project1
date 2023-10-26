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
            <nav>
                <h1 class="nav-text"><a href="student.php" style="color: gray; text-decoration: none">Student</a> > Subject</h1>
            </nav>
            <?php
            if (isset($_GET['id'])) {
                $student_id = $_GET['id'];
                // Replace with your database connection code
                require_once 'db_connection.php';

                $sql = "SELECT i.firstname AS instructor_first, i.lastname AS instructor_last, 
                               isub.schedule, isub.room, es.grade, s.name AS subject_name
                        FROM enrolledstudents es
                        JOIN instructor_subject isub ON es.subject_enrolled = isub.id
                        JOIN subjects s ON isub.subject_id = s.id
                        JOIN instructor i ON isub.instructor_id = i.id
                        WHERE es.student_id = $student_id";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table>
                            <tr>
                                <th>Subject Name</th>
                                <th>Instructor</th>
                                <th>Schedule</th>
                                <th>Room</th>
                                <th>Grade</th>
                            </tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['subject_name'] . "</td>";
                        echo "<td>" . $row['instructor_first'] . " " . $row['instructor_last'] . "</td>";
                        echo "<td>" . $row['schedule'] . "</td>";
                        echo "<td>" . $row['room'] . "</td>";
                        echo "<td>" . $row['grade'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No subjects found for this student.</p>";
                }

                $conn->close();
            } else {
                echo "<p>No student ID specified.</p>";
            }
            ?>
        </div>
        <!-- Content for Student Subjects Page -->
    </div>
</body>

</html>