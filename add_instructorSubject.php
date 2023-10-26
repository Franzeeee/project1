

<?php
require_once "db_connection.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $instructorId = $_POST['id'];
    $subjectId = $_POST['subject'];
    $schedule = $_POST['schedule'];
    $room = $_POST['room'];

    // Add your server-side validation and database insertion logic here
    // Example validation:
    if (empty($subjectId) || empty($schedule) || empty($room)) {
        echo "Validation error: All fields are required.";
        http_response_code(400); // Bad Request
    } else {
        $sql = "INSERT INTO instructor_subject (subject_id, instructor_id, schedule, room, totalStudents) VALUES (?, ?, ?, ?, ?)";
        $totalStudents = 0;

        // Create a prepared statement
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters and execute the query
            $stmt->bind_param("iisss", $subjectId, $instructorId, $schedule, $room, $totalStudents);

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
    }
} else {
    echo "Invalid request method.";
    http_response_code(405);
}

// Close the database connection
$conn->close();
