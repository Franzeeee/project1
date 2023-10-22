<?php
require_once "db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form fields are set and not empty


    // Sanitize the input data
    $firstname = isset($_POST["firstname"]) ? mysqli_real_escape_string($conn, $_POST["firstname"]) : "";
    $middlename = isset($_POST["middlename"]) ? mysqli_real_escape_string($conn, $_POST["middlename"]) : "";
    $lastname = isset($_POST["lastname"]) ? mysqli_real_escape_string($conn, $_POST["lastname"]) : "";


    // SQL query to insert data into the instructor table
    $query = "INSERT INTO instructor (firstname, middlename, lastname) VALUES ('$firstname', '$middlename', '$lastname')";

    if ($conn->query($query) === TRUE) {
        // Data inserted successfully
        header('location: instructor.php');
    } else {
        // Error occurred while inserting data
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor</title>
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
            <div class="container pt-3">
                <h2 class="p-3 bg-dark text-center text-light">Add Instructor</h2>

                <form action="add_instructor.php" method="POST">
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" class="form-control p-2" id="firstname" name="firstname" placeholder="Enter First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="middlename">Middle Name:</label>
                        <input type="text" class="form-control p-2" id="middlename" name="middlename" placeholder="Enter Middle Name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" class="form-control p-2" id="lastname" name="lastname" placeholder="Enter Last Name" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 p-2 mt-3">Add Instructor</button>
                </form>
                <button type="submit" class="btn btn-danger mt-2 w-100 p-2" onclick="window.location.href='instructor.php'">Cancel</button>
            </div>
        </main>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="js/instructor.js"></script>
</body>

</html>