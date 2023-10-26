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
    <style>
        /***** SideBar *****/
        .subject {
            background-color: #fff;
            color: black;
        }

        .subject img {
            filter: brightness(0);
        }

        /***** End SideBar *****/

        .wrapper {
            display: flex;
            /* background-color: #f0f0f0; */
        }

        .sidebar {
            width: 250px;
            background-color: #333;
            color: white;
            padding: 20px;
        }

        body {
            background-color: #101010;
            color: white;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        p {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid white;
        }

        th {}

        tr:nth-child(even) {}

        tr:hover {}

        form {
            text-align: center;
            margin: 20px;
        }

        input[type="submit"] {
            background-color: #494949;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color .5s ease;
        }

        input[type="submit"]:hover {
            background-color: #002244;
        }

        main {
            width: calc(100% - 250px);
            background-color: #101010;
            color: white;
        }
    </style>
</head>

<body>
    <div class="wrapper d-flex">
        <?php
        include 'sideBar.php';
        ?>
        <main>
            <h1>Delete Subject</h1>

            <p>Are you sure you want to delete the following subject?</p>

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
        </main>
    </div>
</body>

</html>