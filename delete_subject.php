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
    header("Location: subjects.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "DELETE FROM subjects WHERE id = $subjectId";
    if ($conn->query($sql) === TRUE) {
        header("Location: subject.php");
        exit();
    } else {
        echo "Error deleting subject: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Subject</title>
    <link rel="stylesheet" type="text/css" href="css/delete_subject.css">

</head>

<body>
<div class="container">
    <table>
        <tr>
            <th>Subject Code</th>
            <th>Description</th>
            <th>Unit</th>
        </tr>
        <tr>
            <td><?php echo $subjectCode; ?></td>
            <td><?php echo $description; ?></td>
            <td><?php echo $unit; ?></td>
        </tr>
    </table>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $subjectId; ?>">
        <input type="submit" value="Delete">
    </form>
</body>

</html>