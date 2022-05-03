<?php


session_start();
if (isset($_SESSION["academic_logged_in_session"])) {
    require_once "../../academic/academicQuery/academicQuery.php";
    $academicmail = $_SESSION["academic_logged_in_session"];
    $query = new AcademicQuery();
    $getacademicdetails = $query->getacademicDetails($academicmail);
   
    $academicid = $getacademicdetails[0][0];
    $today = date("Y-m-d");

    if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_FILES["propic"])) {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $receivedfile =$_FILES["propic"];
        require_once "../../fileHandler/filehandler.php";
        $filehandler = new FileHandler();
        $folderpath ="../../academicpropic";
        $fileuploadresult = $filehandler->filedetails($receivedfile, $folderpath, "50000000", "png");
        if ($fileuploadresult) {
            $enteredfilepath = $filehandler->getFilename();
            $updatepropic=$query->updateacademicpropic( $academicid ,$enteredfilepath);
            $updateacademicdetails = $query->updatefnameNlname($academicmail, $fname, $lname);
            if ($updateacademicdetails) {
                echo "Success";
            }
        }
        
    }
    if (isset($_POST["fname"]) && isset($_POST["lname"]) && !isset($_FILES["propic"])) {

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $updateacademicdetails = $query->updatefnameNlname($academicmail, $fname, $lname);
        if ($updateacademicdetails) {
            echo "Success";
        }
    }
}
