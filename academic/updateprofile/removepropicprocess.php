<?php
session_start();
if (isset($_SESSION["academic_logged_in_session"])) {
    require_once "../../academic/academicQuery/academicQuery.php";
    $academicmail = $_SESSION["academic_logged_in_session"];
    $query = new AcademicQuery();
    $getacademicdetails = $query->getacademicDetails($academicmail);
    
    $academicid = $getacademicdetails[0][0];
    $today = date("Y-m-d");
    $removeprocess = $query->removepropic($academicid);
    if($removeprocess){
        echo "Success";
    }
}