<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Subject</title>
    <link rel="stylesheet" href="css/instructor.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper">
        <?php
        include 'sideBar.php';
        ?>
        <main>
            <nav>
                <h1 class="nav-text"><a class="navLink" href="instructor.php">Instructor</a> > Subjects</h1>
            </nav>

            <div class="main-content">
                <div class="addInstructorSection">
                    <button class="btn btn-primary">Add New Instructor</button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Middle Name</th>
                            <th scope="col">Total Subjects</th>
                            <th scope="col" class="action">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <tr>
                            <th scope="row">1</th>
                            <td>Doe</td>
                            <td>John</td>
                            <td>Mcdo</td>
                            <td>4</td>
                            <td>
                                <div class="dropdown" id="myDropdown">
                                    <img src="img/3-dots.png" class="dropbtn" onclick="toggleDropdown(this)" alt="">
                                    <div class="dropdown-content">
                                        <a href="#">Edit</a>
                                        <a href="#">Delete</a>
                                        <a href="#">View Subjects</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Burger</td>
                            <td>Mark</td>
                            <td>Jones</td>
                            <td>5</td>
                            <td>
                                <div class="dropdown" id="myDropdown">
                                    <img src="img/3-dots.png" class="dropbtn" onclick="toggleDropdown(this)" alt="">
                                    <div class="dropdown-content" id="2">
                                        <a href="#">Edit</a>
                                        <a href="#">Delete</a>
                                        <a href="#">View Subjects</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="js/instructor.js"></script>
</body>

</html>