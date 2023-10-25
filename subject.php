<!DOCTYPE html>
<html>

<head>
    <title>Subject Page</title>
    <style>
        body {
            background-color: darkblue;
            color: white;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid white;
        }

        th {
            background-color: #333;
            color: #ffffff;

        }

        button {
            background-color: #222222;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #051b31;
        }

        p {
            margin-bottom: 10px;
        }

        .add-button {
            text-align: center;
            margin-bottom: 20px;
            background-color: darkblue;
        }

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
            display: grid;
            grid-template-columns: auto 1fr;
        }

        main {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            width: calc(100% - 250px);
            height: 100dvh;
            padding: 0 20px;
            background-color: #333;
            color: #ffffff;
        }

        nav {
            width: 100%;
            padding: 20px 0 5px;
            border-bottom: 3px solid rgba(22, 22, 22, 0.17);
        }

        nav h1 {
            font-size: 1.4rem;
            color: #fafafa;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
        }
    </style>

</head>

<body>
    <div class="wrapper d-flex">
        <?php
        include 'sideBar.php';
        ?>
        <main>
            <nav>
                <h1 class="nav-text"><a>Subject</a></h1>
            </nav>

            <table>
                <tr>
                    <th>Subject Name</th>
                    <th>Subject Code</th>
                    <th>Description</th>
                    <th>Unit</th>
                    <th>Action</th>
                </tr>
                <?php
                require_once 'db_connection.php';

                $sql = "SELECT * FROM subjects";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["code"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["unit"] . "</td>";
                        echo "<td>";
                        echo "<button onclick='editSubject(" . $row["id"] . ")'>Edit</button>";
                        echo "<button onclick='deleteSubject(" . $row["id"] . ")'>Delete</button>";
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
                    <h3>Add Subject</h3>
                </button>
            </div>

    </div>
    </main>

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