<?php
session_start();
if (isset($_SESSION["teacher_logged_in_session"])) {
 
    require_once "../../teacher/teacherQuery/teacherQuery.php";
    $teachermail = $_SESSION["teacher_logged_in_session"];
    $query = new TeacherQuery();
    $getteacherdetails = $query->getTeacherDetails($teachermail);
    $teachersubjectid = $getteacherdetails[0][5];
    $teacherid = $getteacherdetails[0][0];
    
?>
    <div>
    <?php
    if (isset($_POST["grade_id"])) {
        $gradeid = $_POST["grade_id"];
        require_once "../../inputValidations/ValidateInputs.php";
        $validation = new ValidateInputs();
        $gradevali = $validation->gradeVali($gradeid);
        if($gradevali){
        $getsubmittedstudents = $query->getsubmittedstudentbygrade($gradeid,$teachersubjectid);
        $sumittedstudentrowcount =count($getsubmittedstudents);
        echo "</br>";
        $submittedstudentArray = [];
        print_r($getsubmittedstudents[0]);
        echo "</br>";
        if($sumittedstudentrowcount>=1 || $getsubmittedstudents[0] =="Nothing"){
            for($i=0;$i<$sumittedstudentrowcount;$i++){
                $submittedstudentid =$getsubmittedstudents[$i][0];
                echo $submittedstudentid;
            }
        }
    
          echo "</br>";

        //   $getstudents = $query->getstudentsbygrade($gradeid);
        //   $rowcount =count($getstudents);
        //   $eachstudent = [];
        //   for($i=0;$i<$rowcount;$i++){
        //         echo   $getstudents[$i][1];
        //         echo "</br>";
               
        //   } 
        }
       
    }
}
    ?>
    </div>