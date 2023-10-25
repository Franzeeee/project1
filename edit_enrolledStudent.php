<?php
require_once 'db_connection.php';

// Fetch the subject of the instructor
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM enrolledstudents WHERE id = $id";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();

        $data = array(
            'grade' => $row['grade'],
        );

        echo json_encode($data);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data from the form
    $id = intval($_POST["id"]);
    // Convert to int
    $grade = $_POST["grade"];

    // Create a prepared statement
    $query = "UPDATE enrolledstudents SET grade = ? WHERE id = ?";

    $stmt = $conn->prepare($query);

    // Bind the parameters and execute the query
    $stmt->bind_param("si", $grade, $id);

    if ($stmt->execute()) {
        echo  "<script>alert('Data Updated Successfully')</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}



$conn->close();
