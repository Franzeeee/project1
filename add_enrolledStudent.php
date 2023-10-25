<?php
require_once "db_connection.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $subjectID = intval($_POST['id']);
    $studentID = intval($_POST['student']);
    $grade = $_POST['grade'];

    $sql = "INSERT INTO enrolledstudents (student_id, subject_enrolled, grade) VALUES (?, ?, ?)";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters and execute the query
        $stmt->bind_param("iis", $studentID, $subjectID, $grade);

        if ($stmt->execute()) {
            echo "Data added successfully!";
        } else {
            echo "Failed to insert data: " . $conn->error;
            http_response_code(500); // Internal Server Error
        }
    } else {
        echo "Failed to prepare the SQL statement: " . $conn->error;
        http_response_code(500); // Internal Server Error
    }
} else {
    echo "Invalid request method.";
    http_response_code(405);
}

// Close the database connection
$conn->close();
