<?php
session_start();
if (!isset($_SESSION["teacher_logged_in_session"])) {
    header('Location: /webAssignment/teacher/teacherlogin/teacherlogin.php');
} else {
    $email = $_SESSION["teacher_logged_in_session"];
    unset($_SESSION["teacher_logged_in_session"]);
    header('Location: /webAssignment/teacher/teacherlogin/teacherlogin.php');

}