<?php
require_once 'sideBar-Style.php';


if ($_SERVER['REQUEST_URI'] == "/project1/sidebar.php") {
    header('Location: subject.php');
    exit;
}


?>

<section>
    <h2><img class="logo" src="img/school-icon.png">iEducatePro</h2>

    <ul>
        <a href="subject.php">
            <li class="subject">
                <img src="img/subject-icon.png" alt="A photo of a stacked book">
                Subject
            </li>
        </a>
        <a href="instructor.php">
            <li class="instructor">
                <img src="img/instructor-icon.png" alt="An icon representing instructor">
                Instructor
            </li>
        </a>
        <a href="student.php">
            <li class="student">
                <img src="img/student-icon.png" alt="An icon representing instructor">
                Student
            </li>
        </a>
    </ul>
    <div class="user w-100 bg-light">
        <img src="img/man.png" class="user-profile" alt="">
        <div class="user-name">
            <div class="name">John Doe</div>
            <div class="user-type">Admin</div>
        </div>
        <img src="img/logout.png" id="logoutButton" class="logout" alt="">
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#logoutButton").click(function() {
            $.ajax({
                url: 'logout.php',
                method: 'POST',
                success: function(response) {
                    if (response === 'success') {
                        alert('Logout Successfully');
                        window.location.href = 'login.php'; // Redirect to the login page
                    } else {
                        alert('Failed to destroy session');
                    }
                }
            });
        });
    });
</script>