<?php
session_start();

if (isset($_POST["verifycode"]) && isset($_SESSION["academic_session_mail"])) {

    $verifycode = $_POST["verifycode"];
    $email = $_SESSION["academic_session_mail"];
    require_once "../../academic/academicQuery/academicQuery.php";
    $query = new AcademicQuery();
    $academicCheck = $query->checkVerificationCodebyemailNcode($email, $verifycode);
    if ($academicCheck == true) {
        $academicCheck = $query->removeverificationcoderow($verifycode);
        echo "Success";
    } else {
        echo "Wrong Code";
    }
} else {
    echo "Something Wrong please try again";
}
