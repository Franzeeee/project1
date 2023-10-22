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
        <img src="img/logout.png" class="logout" alt="">
    </div>
</section>