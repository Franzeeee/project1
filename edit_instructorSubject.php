

<?php
require_once 'db_connection.php';

// Fetch the subject of the instructor
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM instructor_subject WHERE id = $id";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();

        $data = array(
            'subject_id' => $row['subject_id'],
            'schedule' => $row['schedule'],
            'room' => $row['room']
        );

        echo json_encode($data);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data from the form
    $Strid = $_POST["id"];
    // Convert to int
    $id = intval($Strid);
    $subject = $_POST["subject"];
    // Convert to int
    $subjectId = intval($subject);
    $schedule = $_POST["schedule"];
    $room = $_POST["room"];

    // Create a prepared statement
    $query = "UPDATE instructor_subject SET subject_id = ?, schedule = ?, room = ? WHERE id = ?";

    $stmt = $conn->prepare($query);

    // Bind the parameters and execute the query
    $stmt->bind_param("issi", $subjectId, $schedule, $room, $id);

    if ($stmt->execute()) {
        echo  "<script>alert('Data Updated Successfully')</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
}



$conn->close();
