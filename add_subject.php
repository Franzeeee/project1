<!DOCTYPE html>
<html>

<head>
    <title>Add Subject</title>
    <?php
    include_once 'sideBar-Style.php';
    ?>
    <style>
        body {
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
            background-color: #101010;
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
            /* background-color: gray; */
            color: white;
            border: none;
            padding: 15px 25px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
            background-color: #222222;
            transition: background-color .5s ease;
        }

        input[type="submit"]:hover {
            background-color: #051b31;
        }

        button {
            padding: 10px 25px;
            width: 10%;
            margin: 0 auto;
            outline: none;
            background-color: #af0e0e;
            border-radius: 5px;
            border: none;
            color: #fff;
            max-width: 135px;
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
            <button onclick="window.history.back()">Cancel</button>
        </main>
    </div>
</body>

</html>