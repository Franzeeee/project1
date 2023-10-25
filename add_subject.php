<!DOCTYPE html>
<html>

<head>
    <title>Add Subject</title>
    <?php
    include_once 'sideBar-Style.php';
    ?>
    <style>
        body {
            background-color: darkblue;
            color: white;
            font-family: Arial, sans-serif;
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
            display: flex;
            /* background-color: #f0f0f0; */
        }

        .sidebar {
            width: 250px;
            background-color: #333;
            color: white;
            padding: 20px;
        }

        main {
            display: flex;
            flex-direction: column;
            width: calc(100% - 250px);
        }

        h1 {
            text-align: center;
        }

        form {
            text-align: center;
            margin: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
            text-align: left;

        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: darkblue;
            color: white;
            border: none;
            padding: 15px 25px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
            background-color: #002244;
            transition: background-color .5s ease;
        }

        input[type="submit"]:hover {
            background-color: #0073e5;
        }
    </style>
</head>

<body>
    <div class="wrapper d-flex">
        <?php
        include_once 'sideBar.php';
        ?>
        <main>
            <h1>Add Subject</h1>
            <form action="save_subject.php" method="POST">

                <label for="description">Subject Name:</label>
                <input type="text" id="description" name="subject_name" required>

                <label for="subject_code">Subject Code:</label>
                <input type="text" id="subject_code" name="subject_code" required>

                <label for="description">Description:</label>
                <input type="text" id="description" name="description" required>

                <label for="unit">Unit:</label>
                <input type="number" id="unit" name="unit" required>

                <input type="submit" value="Add Subject">
            </form>
        </main>
    </div>
</body>

</html>