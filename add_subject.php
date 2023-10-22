<!DOCTYPE html>
<html>
<head>
    <title>Add Subject</title> 
    <link rel="stylesheet" type="text/css" href="css/add_subject.css">

</head>
<body>

    <form action="save_subject.php" method="POST">
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
