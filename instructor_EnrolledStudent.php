<?php
require_once 'db_connection.php';

if (isset($_GET['id'])) {

    $subjectEnrolled = $_GET['id'];
}

$subjectId =  $subjectEnrolled;

$sql = "SELECT s.id, s.firstname, s.lastname
        FROM students s
        LEFT JOIN enrolledstudents es ON s.id = es.student_id AND es.subject_enrolled = $subjectId
        WHERE es.student_id IS NULL";

$result = $conn->query($sql);

if ($result) {
    // Initialize an empty associative array to store the results
    $studentData = array();

    // Fetch and store data in the key-value pair array
    while ($row = $result->fetch_assoc()) {
        $studentData[$row['id']] = $row['lastname'] . ', ' . $row['firstname'];
    }
} else {
    echo "Error executing SQL query: " . $conn->error;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Subject</title>
    <link rel="stylesheet" href="css/instructor.css">
    <link rel="stylesheet" href="css/add_instructor.css">
    <link href="bootstrap/" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper">
        <?php
        include 'sideBar.php';
        ?>
        <main>
            <nav>
                <h1 class="nav-text"><a class="navLink" href="instructor.php">Instructor</a> > <a class="navLink" onclick="window.history.back()">Subjects</a> > Students</h1>
            </nav>

            <div class=" main-content">
                <div class="addInstructorSection justify-content-between">
                    <h5 class="">Subject: <?php echo $_GET['subjectName'] ?></h5>
                    <button class="btn btn-primary showAddModal">Add Student</button>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Student ID #</th>
                            <th scope="col">Grade</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                        <?php
                        $sql = "SELECT e.id, s.lastname, s.firstname, e.grade
                                FROM enrolledstudents e
                                JOIN students s ON e.student_id = s.id
                                WHERE e.subject_enrolled = ?";

                        // Create a prepared statement
                        $stmt = $conn->prepare($sql);

                        // Bind the parameter
                        $stmt->bind_param("i", $subjectEnrolled);

                        // Execute the query
                        $stmt->execute();

                        // Get the result
                        $result = $stmt->get_result();
                        $counter = 0;
                        // Fetch and process the rows
                        while ($row = $result->fetch_assoc()) {
                            $counter++;
                            echo '<tr>
                                        <th scope="row">' . $counter . '</th>
                                        <td>' . $row['firstname'] . " " . $row['lastname'] . '</td>
                                        <td>' . $row['id'] . '</td>
                                        <td>' . $row['grade'] . '</td>
                                        <td>
                                            <div class="dropdown" id="myDropdown">
                                                <img src="img/3-dots.png" class="dropbtn" onclick="toggleDropdown(this)" alt="">
                                                <div class="dropdown-content">
                                                    <a class="editModal-Student" data-id="' . $row['id'] . '">Edit Grade</a>
                                                    <a class="showDeleteModal" data-id="' . $row['id'] . '">Delete Student</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>';
                        }

                        // Close the statement and the connection
                        $stmt->close();
                        ?>

                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Add Modal -->
    <div class="addModal w-100 h-100 position-absolute top-0 left-0 d-none" style="background-color: #00000085;">
        <div class="addModalContainer w-50 h-75 bg-light m-auto mt-4 rounded-top d-flex flex-column justify-content-start align-items-center">
            <h1 class="w-100 bg-dark p-3 text-center text-light rounded-top">Add Student</h1>
            <form action="add_enrolledStudent.php" method="POST" class="addStudentForm p-5 pt-3 w-100">
                <input type="hidden" name="id" value="<?php echo $subjectEnrolled; ?>">
                <div class="form-group col-auto">
                    <label for="inputState" class="h5">Students: </label>
                    <select id="inputState" class="form-control p-2" name="student" required>
                        <option selected>Choose Student...</option>
                        <?php
                        foreach ($studentData as $id => $name) {
                            echo '<option value="' . $id . '">' . $name . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="h5 mt-2" for="grade">Grade: </label>
                    <input type="text" class="form-control p-2" id="schedule" placeholder="Grades: 1-3, 5, INC and DRP" value="No Grade" name="grade" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 p-2 mt-5">Submit</button>
            </form>

            <button class="btn btn-danger w-75 p-2" id="cancelAdd">Cancel</button>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="editModal w-100 h-100 position-absolute top-0 left-0 d-none" style="background-color: #00000085;z-index: 9999">
        <div class="addModalContainer w-50 h-50 bg-light m-auto mt-2 rounded-top d-flex flex-column justify-content-start align-items-center">
            <h1 class="w-100 bg-dark p-3 text-center text-light rounded-top">Edit Grade</h1>
            <form action="edit_enrolledStudent.php" method="POST" class="editForm updateSubjectForm p-5 pt-3 w-100">
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                    <label class="h5 mt-2" for="Room">Grade:</label>
                    <input type="text" class="form-control p-2" id="grade" placeholder="Grades(1-3, 5, INC, and DRP)" name="grade" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 p-2 mt-3">Submit</button>
            </form>
            <button class="btn btn-danger w-75 p-2" id="cancelEdit">Cancel</button>
        </div>
    </div>


    <!--Delete Modal-->
    <div class="deleteModal d-none">
        <div class="modalContainer">
            <h1 class="deleteModalHeader">Delete</h1>
            <div class="deleteContent">
                <h3>Are you sure you want to delete?</h3>
                <div class="deletebuttons d-flex flex-column mt-4">
                    <button class="btn btn-danger mb-2 rounded-0 p-2" id="confirmDeleteButton">Confirm</button>
                    <button class="btn btn-light border rounded-0 p-2" id="cancelDeleteButton">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="js/enrolledStudent.js"></script>
</body>

</html>