<?php
session_start();
if (isset($_SESSION["teacher_logged_in_session"])) {
    require_once "../../teacher/teacherQuery/teacherQuery.php";
    $teachermail = $_SESSION["teacher_logged_in_session"];
    $query = new TeacherQuery();
    $getteacherdetails = $query->getTeacherDetails($teachermail);
    $teachersubjectid = $getteacherdetails[0][5];
    $teacherid = $getteacherdetails[0][0];

    if (isset($_POST["grade"]) && isset($_POST["lname"]) && isset($_FILES["lfile"])) {
        require_once "../../inputValidations/ValidateInputs.php";
        $validation = new ValidateInputs();
        $grade = $_POST["grade"];
        $lessonname = $_POST["lname"];
        $receivedfile = $_FILES["lfile"];

        $gradeVali = $validation->gradeVali($grade);
        $nameVali = $validation->stringVali($lessonname);
        $foldername = "../../lessonnotes";
        if ($gradeVali && $nameVali) {

            require_once "../../fileHandler/filehandler.php";
            $filehandler = new FileHandler();
            $fileuploadedstatus = $addfiles = $filehandler->filedetails($receivedfile, $foldername, "50000000", "pdf");
            $createdfilepath = $filehandler->unique_name_generated;

            if ($fileuploadedstatus) {
                


                $addlessonquerystatus = $query->addlessonnotes($createdfilepath, $lessonname, $grade, $teachersubjectid,$teacherid);
                if($addlessonquerystatus){
                    echo "Success";
                }
            }
        }
    } else {
        echo "couldn't receive any data";
    }
} else {
}
