<!DOCTYPE html>
<html>

<head>
    <title>Add Subject</title>
    <style>
        body {
            background-color: darkblue;
            color: white;
            font-family: Arial, sans-serif;
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
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #002244;
        }
    </style>
</head>

<body>
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
</body>

</html>