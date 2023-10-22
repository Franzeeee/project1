<?php
require_once 'db_connection.php';

if (isset($_GET['id'])) {
    $subjectId = $_GET['id'];

    $sql = "SELECT * FROM subjects WHERE id = $subjectId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $subjectCode = $row["code"];
        $description = $row["description"];
        $unit = $row["unit"];
    } else {
        header("Location: subject.php");
        exit();
    }
} else {
    header("Location: subject.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subjectCode = $_POST["subject_code"];
    $description = $_POST["description"];
    $unit = $_POST["unit"];

    $sql = "UPDATE subjects SET code = '$subjectCode', description = '$description', unit = $unit WHERE id = $subjectId";
    if ($conn->query($sql) === TRUE) {
        header("Location: subject.php");
        exit();
    } else {
        echo "Error updating subject: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Subject</title>
    <link rel="stylesheet" type="text/css" href="css/edit_subject.css">

</head>

<body>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $subjectId; ?>">
        <label for="subject_code">Subject Code:</label>
        <input type="text" name="subject_code" value="<?php echo $subjectCode; ?>" required><br>

        <label for="description">Description:</label>
        <input type="text" name="description" value="<?php echo $description; ?>" required><br>

        <label for="unit">Unit:</label>
        <input type="number" name="unit" value="<?php echo $unit; ?>" required><br>

        <input type="submit" value="Update">
    </form>
</body>

</html>