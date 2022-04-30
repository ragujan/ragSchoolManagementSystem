<?php
session_start();

if (isset($_POST["verifycode"]) && isset($_SESSION["student_session_mail"])) {

    $verifycode = $_POST["verifycode"];
    $email = $_SESSION["student_session_mail"];
    require_once "../../student/studentQuery/studentQuery.php";
    $query = new StudentQuery();
    $studentCheck = $query->checkVerificationCodebyemailNcode($email, $verifycode);
    if ($studentCheck == true) {
        $studentCheck = $query->removeverificationcoderow($verifycode);
        echo "Success";
    } else {
        echo "Wrong Code";
    }
} else {
    echo "Something Wrong please try again";
}
