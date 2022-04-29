<?php
session_start();
if (isset($_SESSION["teacher_logged_in_session"])) {
    require_once "../../teacher/teacherQuery/teacherQuery.php";
    $teachermail = $_SESSION["teacher_logged_in_session"];
    $query = new TeacherQuery();
    $getteacherdetails = $query->getTeacherDetails($teachermail);
    $teachersubjectid = $getteacherdetails[0][5];
    $teacherid = $getteacherdetails[0][0];

    if (isset($_POST["grade"]) && isset($_POST["lname"]) && isset($_FILES["lfile"]) && isset($_POST["duedate"])) {
        require_once "../../inputValidations/ValidateInputs.php";
        $validation = new ValidateInputs();
        $grade = $_POST["grade"];
        $assignmentname = $_POST["lname"];
        $dueDate = $_POST["duedate"];
        $receivedfile = $_FILES["lfile"];
       echo $dueDate;
       echo $dueDate;
       echo $dueDate;
        $gradeVali = $validation->gradeVali($grade);
        $nameVali = $validation->stringVali($assignmentname);
     //   $dateVali = $validation->dateVali($dueDate);
        $foldername = "../../assignmentS";
        if ($gradeVali && $nameVali ) {

            require_once "../../fileHandler/filehandler.php";
            $filehandler = new FileHandler();
            $fileuploadedstatus = $addfiles = $filehandler->filedetails($receivedfile, $foldername, "50000000", "pdf");
            $createdfilepath = $filehandler->unique_name_generated;

            if ($fileuploadedstatus) {
                


                $addassignmentquerystatus = $query->addassignment($createdfilepath, $assignmentname, $grade, $teachersubjectid,$teacherid,$dueDate);
                if($addassignmentquerystatus){
                    echo "Success";
                }
            }else{
                echo "Here";
            }
        }else{
            echo "validation";
        }
    } else {
        echo "couldn't receive data properly";
    }
} else {
}
