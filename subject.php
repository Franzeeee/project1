<!DOCTYPE html>
<html>

<head>
    <title>Subject Page</title>
    <link rel="stylesheet" type="text/css" href="css/subject.css">
</head>

<body>
    <div class="wrapper d-flex">
        <?php
        include 'sideBar.php';
        ?>

        <main>
            <h2>List of Subjects</h2>

            <table>
                <tr>
                    <th>Subject Code</th>
                    <th>Description</th>
                    <th>Unit</th>
                    <th></th>
                </tr>
                <?php
                $servername = "localhost";
                $username = 'root';
                $password = '';
                $dbname = 'project1';

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM subjects";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["code"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["unit"] . "</td>";
                        echo "<td>";
                        echo "<button class='edit-button' onclick='editSubject(" . $row["id"] . ")'>Edit</button>";
                        echo "<button class='delete-button' onclick='deleteSubject(" . $row["id"] . ")'>Delete</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No subjects found.</td></tr>";
                }

                $conn->close();
                ?>
            </table>

            <div class="add-button">
                <button onclick="location.href='add_subject.php'">
                    <h5>Add Subject</h5>
                </button>
            </div>
        </main>
    </div>

    <script>
        function editSubject(subjectId) {
            window.location.href = "edit_subject.php?id=" + subjectId;
        }

        function deleteSubject(subjectId) {
            if (confirm("Are you sure you want to delete this subject?")) {
                window.location.href = "delete_subject.php?id=" + subjectId;
            }
        }
    </script>
</body>

</html>
