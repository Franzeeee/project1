
<?php
require_once "db_connection.php"; // Include your database connection file

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // SQL query to delete data from the database
    $query = "DELETE FROM instructor_subject WHERE id = ?"; // Replace your_table_name with the actual table name
    $stmt = $conn->prepare($query);

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo 'success'; // Return a success message to the client
    } else {
        echo 'error'; // Return an error message to the client
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    echo 'Invalid request'; // Handle cases where no ID is provided
}
