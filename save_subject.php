<?php
require_once 'db_connection.php';

$subjectCode = $_POST['subject_code'];
$description = $_POST['description'];
$unit = $_POST['unit'];

$sql = "INSERT INTO subjects (code, description, unit) VALUES ('$subjectCode', '$description', '$unit')";
if ($conn->query($sql) === TRUE) {
    echo "Subject added successfully";
    header('location: subject.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
