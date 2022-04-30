<?php
session_start();
if (!isset($_SESSION["student_logged_in_session"])) {
    die();
} else {
    $email = $_SESSION["student_logged_in_session"];
?>

    <div class="row">
        <div class="col-12 text-center ">
            <span class="fw-bold text-danger" id="upAddstudenterrormessage"></span>
        </div>
        <div class="col-6">
            <span>assignment_name</span>
            <input type="text" id="studentassignmentname" class="w-100 px-2 py-2">
        </div>

        <div class="col-6">
            <span>assignment_name</span>
            <div>
                <label class="w-100 px-2 py-2 bg-white text-dark" for="studentassignmentpdf">Upload assignments</label>
            </div>

            <input class="d-none" type="file" id="studentassignmentpdf" class="w-100 px-2 py-2">
        </div>
 

        <div class="col-6">
            <span>select_grade</span>

            <select id="assignmentgrade" class="w-100 px-2 py-2">
                <?php
                require_once "../../student/studentQuery/studentQuery.php";
                $query = new studentQuery();
                $querygrade = $query->getstudentgrade($email);
                $rowCount = $query->rowCount;
                for ($i = 0; $i < $rowCount; $i++) {
                    $gradeName = $querygrade[$i][1];
                    $gradeID = $querygrade[$i][0];
                ?>
                    <option class="py-2" value="<?php echo $gradeID ?>">
                        <?php echo $gradeName; ?>
                    </option>
                <?php
                }
                ?>


            </select>
        </div>
        <div class="col-6">
            <span>select_subject</span>

            <select id="assignmentgrade" class="w-100 px-2 py-2">
                <?php
                require_once "../../student/studentQuery/studentQuery.php";
                $query = new studentQuery();
                $querysubject = $query->getSubjects($email);
                $rowCount = $query->rowCount;
                for ($i = 0; $i < $rowCount; $i++) {
                    $subjectName = $querysubject[$i][1];
                    $subjectID = $querysubject[$i][0];
                ?>
                    <option class="py-2" value="<?php echo $subjectID ?>">
                        <?php echo $subjectName; ?>
                    </option>
                <?php
                }
                ?>


            </select>
        </div>
        <div class="col-12 text-center py-4">
            <button onclick="uploadassignments();" class="ragFancyButton px-2 py-2 w-50">Add assignment</button>
        </div>
    </div>

<?php
}
?>