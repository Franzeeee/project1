<?php
$servername = "localhost";
$username = 'root';
$password = '';
$dbname = 'subjects_db';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$subjectCode = $_POST['subject_code'];
$description = $_POST['description'];
$unit = $_POST['unit'];

$sql = "INSERT INTO subjects (subject_code, description, unit) VALUES ('$subjectCode', '$description', '$unit')";
if ($conn->query($sql) === TRUE) {
    echo "Subject added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
