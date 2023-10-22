<?php
require_once "db_connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor</title>
    <link rel="stylesheet" href="css/instructor.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper">
        <?php
        include 'sideBar.php';
        ?>
        <main>
            <nav>
                <h1 class="nav-text"><a>Instructor</a></h1>
            </nav>

            <div class="main-content">
                <div class="addInstructorSection">
                    <button class="btn btn-primary" onclick="window.location.href='add_instructor.php'">Add New Instructor</button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Total Subjects</th>
                            <th scope="col" class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">

                        <?php
                        $query = "SELECT * FROM instructor";
                        $result = $conn->query($query);

                        $rowIndex = 0;
                        // Check if there are results
                        if ($result->num_rows > 0) {
                            // Output data for each row
                            while ($row = $result->fetch_assoc()) {
                                $rowIndex++;
                                echo ' <tr>
                                <th scope="row">' . $rowIndex . '</th>
                                <td>' . $row['lastname'] . '</td>
                                <td>' . $row['firstname'] . '</td>
                                <td>' . $row['middlename'] . '</td>
                                <td>4</td>
                                <td>
                                    <div class="dropdown" id="myDropdown">
                                        <img src="img/3-dots.png" class="dropbtn" onclick="toggleDropdown(this)" alt="">
                                        <div class="dropdown-content">
                                            <a data-id="' . $row['id'] . '" class="edit-button">Edit</a>
                                            <a data-id="' . $row['id'] . '" class="showDeleteModal">Delete</a>
                                            <a href="instructor_subject.php?id=' . $row['id'] . '">View Subjects</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>';
                            }
                        } else {
                            echo "No data found in the database.";
                        }

                        // Close the database connection
                        $conn->close();

                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
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
    <script defer src="js/instructor.js"></script>
</body>

</html>