<?php


session_start();
if (isset($_SESSION["student_logged_in_session"])) {
    require_once "../../student/studentQuery/studentQuery.php";
    $studentmail = $_SESSION["student_logged_in_session"];
    $query = new StudentQuery();
    $getstudentdetails = $query->getstudentDetails($studentmail);
    $studentgradeid = $getstudentdetails[0]['grade_id'];
    $studentid = $getstudentdetails[0][0];
    $today = date("Y-m-d");

    if (isset($_POST["subject"]) && isset($_POST["assignmentid"]) &&  isset($_FILES["lfile"])) {
        require_once "../../student/studentQuery/studentQuery.php";
        $query = new studentQuery();
        $subjectID = $_POST["subject"];

        $receivedfile = $_FILES["lfile"];
        $assignmentcode = $_POST["assignmentid"];

        $folderpath = "../../submittedassignments";
        require_once "../../inputValidations/ValidateInputs.php";
        $validation = new ValidateInputs();
        $subectVali = $validation->intIDvalid($subjectID);
        $assignmentidVali = $validation->emptyCheck($assignmentcode);
        if ($subectVali && $assignmentidVali) {
            $getassignmentdetails = $query->getassignmentfulldetailsbycode($assignmentcode);
            $assignmentduedate = $getassignmentdetails[0]['assignment_due_date'];
            $datedifference = $validation->getDateDifference2($assignmentduedate);
            if ($datedifference < 0) {
                
                exit("dead line is reached");
            }

            
            require_once "../../fileHandler/filehandler.php";
            $filehandler = new FileHandler();
            $fileuploadresult = $filehandler->filedetails($receivedfile, $folderpath, "50000000", "pdf");
            if ($fileuploadresult) {
                $enteredfilepath = $filehandler->getFilename();



                $insertquery = $query->insertassignment($today, $subjectID, $studentgradeid, $assignmentcode, $studentid, $enteredfilepath);
            }
        } else {
            echo "Not proper input fields";
        }
    } else {
        echo "couldn't receive data properly";
    }
}
