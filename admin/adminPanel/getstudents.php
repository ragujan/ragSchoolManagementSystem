<?php
session_start();
if (!isset($_SESSION["AdminSession"])) {
    exit();
} else {
?>

    <div class="row ">
        <div class="col-12 subjectNameHolderDiv">
            <div class="row">

                <?php
                require_once "../../admin/adminPanel/StudentQuery.php";
                $query = new StudentQuery();
      //run the get students method to execute the student search query for 
                //the student table to the student details
                $querystudent = $query->getstudents();
                $rowCount = $query->rowCount;
                for ($i = 0; $i < $rowCount; $i++) {
                    $studentStatus = $querystudent[$i]["student_status"];
                    $studentID =  $querystudent[$i][0];
                    $studentFName = $querystudent[$i][1];
                    $studentLName = $querystudent[$i][2];
                    $studentEmail = $querystudent[$i][5];
                    $studentDueDate = $querystudent[$i][9];
                    require_once "../../inputValidations/ValidateInputs.php";

                    $validation = new ValidateInputs();
                    $dateGap = $validation->getDateDifference($studentDueDate);

                ?>



                    <div class="col-12  subjectDivs my-1 py-2">
                        <div class="row">
                            <div class="col-lg-3 py-2 py-md-1 py-lg-1 col-sm-6  col-6 col-md-2 text-start text-md-start">
                                <div class="row">
                                    <div class="col-6">
                                        <span class=""><?php echo $studentFName; ?></span>
                                    </div>
                                    <div class="col-6">
                                        <span class=""><?php echo $studentLName; ?></span>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-4 py-2 py-md-1 py-lg-1 col-sm-12 col-12 col-md-4 text-start text-md-start">
                                <?php
                                if ($dateGap > 30) {
                                ?>
                                    <button onclick="sendEmailtostudent('<?php echo $studentID ?>','<?php echo $studentEmail; ?>');" class="btn-danger text-white fw-bold py-1"><?php echo $studentEmail; ?></button>
                                <?php
                                } else {
                                ?>
                                    <span class=""><?php echo $studentEmail; ?> </span>
                                <?php
                                }
                                ?>

                            </div>
                            <div class="col-lg-3 py-2 py-md-1 py-lg-1 col-sm-6  col-md-2 col-6 text-center">
                                <div class="row">
                                    <div class="col-6"><button onclick="viewIndividualstudentResults(<?php echo $studentID; ?>);" class="ragFancyButton">See Results</button></div>
                                    <div class="col-6"><button onclick="changeGrade(<?php echo $studentID; ?>);" class="ragFancyButton">Change Grades</button></div>
                                </div>

                            </div>
                            <?php
                            if ($studentStatus == 0) {
                            ?>
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-sm-6  col-md-2  col-6 text-center">
                                    <button class="ragFancyButton" onclick="askRemoveThestudent('<?php echo $studentID; ?>','<?php echo $studentEmail; ?>','<?php echo $studentFName; ?>')">UnBlock Student</button>
                                    <!-- <img src="../../icons/delete.png"  class="updateIcon " alt="" srcset=""> -->
                                </div>
                            <?php
                            } else if ($studentStatus == 1) {
                            ?>
                                <div class="col-lg-2 py-2 py-md-1 py-lg-1 col-sm-6  col-md-2  col-6 text-center">
                                    <button class="ragFancyButton" onclick="askRemoveThestudent('<?php echo $studentID; ?>','<?php echo $studentEmail; ?>','<?php echo $studentFName; ?>')">Block Student</button>
                                    <!-- <img src="../../icons/delete.png"  class="updateIcon " alt="" srcset=""> -->
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php
}
?>