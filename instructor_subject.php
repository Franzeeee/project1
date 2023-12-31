<?php
require_once 'db_connection.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM instructor WHERE id = " . $id;
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();


        $instructorName = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'];
    } else {
        echo "Error executing SQL query: " . $conn->error;
    }
} else {
    header('location: instructor.php');
}

$instructorId = $id;
$sql = "SELECT s.id, s.name
        FROM subjects s
        LEFT JOIN instructor_subject isub ON s.id = isub.subject_id AND isub.instructor_id = $instructorId
        WHERE isub.subject_id IS NULL";

$result = $conn->query($sql);

if ($result) {
    // Initialize an empty associative array to store the results
    $subjectData = array();

    // Fetch and store data in the key-value pair array
    while ($row = $result->fetch_assoc()) {
        $subjectData[$row['id']] = $row['name'];
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper">
        <?php
        include 'sideBar.php';
        ?>
        <main>
            <nav>
                <h1 class="nav-text"><a class="navLink" href="instructor.php">Instructor</a> > Subjects</h1>
            </nav>

            <div class="main-content">
                <div class="addInstructorSection justify-content-between">
                    <h5 class="">Instructor: <?php echo $instructorName ?></h5>
                    <button class="btn btn-primary showAddModal">Add Subject</button>
                </div>
                <table class="table table-dark">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Subject Name</th>
                            <th scope="col">Schedule</th>
                            <th scope="col">Room</th>
                            <th scope="col">Total Students</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <?php
                            $sql = "SELECT isub.*, s.name AS subject_name, (
                                SELECT COUNT(*) 
                                FROM enrolledStudents es
                                WHERE es.subject_enrolled = isub.id
                            ) AS totalStudents
                            FROM instructor_subject AS isub
                            LEFT JOIN subjects AS s ON isub.subject_id = s.id
                            WHERE isub.instructor_id = " . $id;


                            $result = $conn->query($sql);
                            $counter = 0;

                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                                    $counter++;
                                    echo ' <tr>
                                            <th scope="row">' . $counter . '</th>
                                            <td>' . $row['subject_name'] . '</td>
                                            <td>' . $row['schedule'] . '</td>
                                            <td>' . $row['room'] . '</td>
                                            <td>' . $row['totalStudents'] . '</td>
                                            <td>
                                                <div class="dropdown" id="myDropdown">
                                                    <img src="img/3-dots.png" class="dropbtn" onclick="toggleDropdown(this)" alt="">
                                                    <div class="dropdown-content">
                                                        <a class="edit-button" data-name="' . $row['subject_name'] . '" data-id="' . $row['id'] . '">Edit</a>
                                                        <a class="showDeleteModal" data-id="' . $row['id'] . '">Delete</a>
                                                        <a href="instructor_EnrolledStudent.php?subjectName=' . $row['subject_name'] . '&id=' . $row['id'] . '">View Students</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>';
                                }
                                $conn->close();
                            } else {
                                echo "Error executing SQL query: " . $conn->error;
                            }
                            ?>


                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Add Modal -->
    <div class="addModal w-100 h-100 position-absolute top-0 left-0 d-none" style="background-color: #00000085;">
        <div class="addModalContainer w-50 h-75 bg-light m-auto mt-4 rounded-top d-flex flex-column justify-content-start align-items-center">
            <h1 class="w-100 bg-dark p-3 text-center text-light rounded-top">Add Subject</h1>
            <form action="add_instructorSubject.php" class="addSubjectForm p-5 pt-3 w-100">
                <input type="hidden" name="id" id="instructorSub_ID" value="<?php echo $id ?>">
                <div class="form-group col-auto">
                    <label for="inputState" class="h5">Subject: </label>
                    <select id="inputState" class="form-control p-2" name="subject" required>
                        <option selected>Choose Subject...</option>
                        <?php
                        foreach ($subjectData as $id => $name) {
                            echo '<option value="' . $id . '">' . $name . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="h5 mt-2" for="Schedule">Schedule</label>
                    <input type="text" class="form-control p-2" id="schedule" placeholder="ex. MTH 9:00-10:00AM" name="schedule" required>
                </div>
                <div class="form-group">
                    <label class="h5 mt-2" for="Room">Room</label>
                    <input type="text" class="form-control p-2" id="schedule" placeholder="ex. ORC 16" name="room" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 p-2 mt-5">Submit</button>

            </form>
            <button class="btn btn-danger w-75 p-2" id="cancelAdd">Cancel</button>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="editModal w-100 h-100 position-absolute top-0 left-0 d-none" style="background-color: #00000085;z-index: 9999">
        <div class="addModalContainer w-50 h-75 bg-light m-auto mt-4 rounded-top d-flex flex-column justify-content-start align-items-center">
            <h1 class="w-100 bg-dark p-3 text-center text-light rounded-top">Edit Subject</h1>
            <form action="edit_instructorSubject.php" method="POST" class="editForm updateSubjectForm p-5 pt-3 w-100">
                <div class="form-group col-auto">
                    <input type="hidden" name="id" id="instructorSub_ID">
                    <label for=" inputState" class="h5">Subject: </label>
                    <select id="editInputState" class="form-control p-2" name="subject" required>
                        <option selected id="editSubjectId"></option>
                        <?php
                        foreach ($subjectData as $id => $name) {
                            echo '<option value="' . $id . '">' . $name . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="h5 mt-2" for="Schedule">Schedule</label>
                    <input type="text" class="form-control p-2" id="editSchedule" placeholder="ex. MTH 9:00-10:00AM" name="schedule" required>
                </div>
                <div class="form-group">
                    <label class="h5 mt-2" for="Room">Room</label>
                    <input type="text" class="form-control p-2" id="editRoom" placeholder="ex. ORC 16" name="room" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 p-2 mt-5">Submit</button>
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
    <script defer src="js/add_instructor.js"></script>
</body>

</html>