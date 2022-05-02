<?php
session_start();
if (!isset($_SESSION["academic_logged_in_session"])) {
    header('Location: /webAssignment/academic/academiclogin/academiclogin.php');
} else {
    $email = $_SESSION["academic_logged_in_session"];
    unset($_SESSION["academic_logged_in_session"]);
    header('Location: /webAssignment/academic/academiclogin/academiclogin.php');

}