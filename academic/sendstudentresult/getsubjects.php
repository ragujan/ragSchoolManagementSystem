<?php
session_start();
if (!isset($_SESSION["academic_logged_in_session"])) {
    exit();
} else {
?>
    <div class="col-6">
        <span>select_student</span>
        <select onchange="getstudentresults();"  id="getstudent" class="w-100 px-2 py-2">
            <option class="py-2" value="<?php echo ""; ?>">
                <?php echo "Select Student"; ?>
            </option>
            <?php
            if (isset($_POST["grade_id"])) {
                $grade_id = $_POST["grade_id"];

                require_once "../../inputValidations/ValidateInputs.php";
                require_once "../../academic/studentQuery/StudentQuery.php";
                $validation = new ValidateInputs();
                $validgrade_id = $validation->intIDvalid($grade_id);
                if ($validgrade_id) {

                    $studentQuery = new StudentQuery();
                    $getsubmittedstudent = $studentQuery->getsubmittedstudentbygradeid($grade_id);
                    $getsubmittedstudentRowCount = count($getsubmittedstudent);
                    $submittedstudentArray = [];
                    if ($getsubmittedstudent[0] !== "Nothing" && $getsubmittedstudentRowCount >= 1) {
                        for ($i = 0; $i < $getsubmittedstudentRowCount; $i++) {
                            $submittedstudentID = $getsubmittedstudent[$i][7];
                            if (!in_array($submittedstudentID, $submittedstudentArray)) {
                                $submittedstudentArray[$i] = $submittedstudentID;
                            }
                        }

                        $getstudent = $studentQuery->getstudentbygrade($grade_id);
                        $non_duplicated_sumitted_student_count = count($submittedstudentArray);
                        for ($i = 0; $i < $non_duplicated_sumitted_student_count; $i++) {
                            $id =  $submittedstudentArray[$i];
                            $studentdetails = $studentQuery->getstudentbystudentid($id);
                            $studentactualid = $studentdetails[0][0];
                            $studentname =  $studentdetails[0][1];


            ?>
                            <option class="py-2" value="<?php echo $studentactualid; ?>">
                                <?php echo $studentname; ?>
                            </option>
                        <?php
                        }
                        // 
                        ?>
                        <?php

                        ?>



        <?php
                    }
                }
            }
        }
        ?>
        </select>
    </div>