<?php
session_start();
if (isset($_SESSION["teacher_logged_in_session"])) {
?>
    <div>
    <?php
    if (isset($_POST["grade_id"])) {
        $gradeid = $_POST["grade_id"];
        echo $gradeid;
    }
}
    ?>
    </div>