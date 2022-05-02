<?php
session_start();
if (!isset($_SESSION["academic_logged_in_session"])) {
    exit();
} else {
    if (isset($_POST["student_assignment_id"])) {
        $student_assignment_id = $_POST["student_assignment_id"];

        require_once "../../inputValidations/ValidateInputs.php";
        require_once "../../academic/studentQuery/StudentQuery.php";
        $validation = new ValidateInputs();
        $validstudent_assignment_id = $validation->intIDvalid($student_assignment_id);
        if ($validstudent_assignment_id) {
            $studentQuery = new StudentQuery();
            $approvedquerystate = $studentQuery->approveresult($student_assignment_id);
            if($approvedquerystate){
                echo "Success";
            }
           
           
        }
    }
}
?>