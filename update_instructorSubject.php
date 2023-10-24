<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve the data from the form
    $id = $_POST["id"];
    $subject = $_POST["subject"];
    $schedule = $_POST["schedule"];
    $room = $_POST["room"];

    // Create a prepared statement
    $query = "UPDATE instructor_subject SET subject_id = ?, schedule = ?, room = ? WHERE id = ?";

    $stmt = $conn->prepare($query);

    // Bind the parameters and execute the query
    $stmt->bind_param("isss", $subject, $schedule, $room, $id);

    if ($stmt->execute()) {
        echo  "<script>alert('Data Updated Successfully')</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}
