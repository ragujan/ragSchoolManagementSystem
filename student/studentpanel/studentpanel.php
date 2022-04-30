<?php
session_start();
if (!isset($_SESSION["student_logged_in_session"])) {
    header('Location: /webAssignment/student/studentlogin/studentlogin.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/bootstrap.css">
    <link rel="stylesheet" href="../../style/global.css">
    <link rel="stylesheet" href="../../style/student.css">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <div class="col-12 py-5">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-12 px-4  AdminWorkOptions">
                            <div class="row gy-3">
                                <div class="col-6">
                                    <button onclick=";" class="py-2 px-3 fw-bold my-auto w-100 ragFancyButton">View Lesson Notes</button>
                                </div>
                                <div class="col-6">
                                    <button onclick=";" class="py-2 px-3 fw-bold my-auto w-100 ragFancyButton">View Assignments</button>
                                </div>
                                <div class="col-6">
                                    <button onclick="uploadassignment();" class="py-2 px-3 fw-bold my-auto w-100 ragFancyButton">Upload Assignments </button>
                                </div>
                                <div class="col-6">
                                    <button class="py-2 px-3 fw-bold my-auto w-100 ragFancyButton">Add assignment marks</button>
                                </div>
                                <div class="col-6">
                                    <button onclick=";" class="py-2 px-3 fw-bold my-auto w-100 ragFancyButton">Update profile</button>
                                </div>
                                <div class="col-6">
                                    <button class="py-2 px-3 fw-bold my-auto w-100 ragFancyButton">Log Out</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="studentpanel.js"></script>
</body>

</html>