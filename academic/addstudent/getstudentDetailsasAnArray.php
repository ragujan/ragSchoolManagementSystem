<?php
session_start();
if (!isset($_SESSION["academic_logged_in_session"])) {
    exit();
} else {
    if (isset($_POST["id"]) && isset($_POST["email"])) {
        $id = $_POST["id"];
        $email = $_POST["email"];
        require_once "../../inputValidations/ValidateInputs.php";
        $id = $_POST["id"];
        $email = $_POST["email"];
        $validation = new ValidateInputs();
        $valiStatus1 = $validation->intIDvalid($id);
        $valiStatus2 = $validation->mailVali($email);
        if ($valiStatus1 && $valiStatus2) {
            require_once "../../academic/studentQuery/studentQuery.php";
            $query = new StudentQuery();
            $querystudent = $query->getSinglestudent($id, $email);
            $rowCount = $query->rowCount;

            $studentID =  $querystudent[0][0];

            $studentID =  $querystudent[0][0];
            $studentEmail = $querystudent[0][5];
            $studentFName = $querystudent[0][1];
            $studentLName = $querystudent[0][2];        
            $studentGender = $querystudent[0][6];
            $studentAge = $querystudent[0][4];
            $studentGrade = $querystudent[0][8];
            $studentDueDate = $querystudent[0][9];

            $studentArray = array($studentID, $studentEmail, $studentFName, $studentLName, $studentGender, $studentAge, $studentGrade, $studentDueDate);

            echo json_encode($studentArray);
        }
    }
}
