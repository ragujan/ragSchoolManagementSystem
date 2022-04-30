<?php
session_start();
if (isset($_POST["email"])  && isset($_POST["password"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  require_once "../../inputValidations/ValidateInputs.php";
  $validation = new ValidateInputs();
  $emailVali = $validation->mailVali($email);
  $passwordValid= $validation->passwordVali($password);
  if (!$emailVali) {
    exit("Not a Valid Email");
  }
  require_once "../../teacher/teacherQuery/teacherQuery.php";
  $query = new TeacherQuery();

  $teacherDetails = $query->getTeacherDetails($email);
  $teacherID = $teacherDetails[0][0];
  $teacherUserName = $teacherDetails[0][1];
  $teacherCheck = $query->teacherCheckEnP($email, $password);
  if ($teacherCheck == true) {
    $_SESSION["teacher_session_mail"] = $email;
    $checkVerifyCodeTeacher = $query->checkVerificationCodebyemail($email);
    if (!$checkVerifyCodeTeacher) {
      $random = rand();
      $code = hash('md5', $random);

      require "../../SendMail/SendMail.php";
      $emailSender = new SendMail();
      $emailSender->setSenderEmail($email);

      $emailSender->setBody("<h2 style='font-family: Impact, sans-serif;
      color: #CE5937;'>
        Your User_name and Verification Code 
        </h2>
        <span>Verification Code</span>
        <input style='width:50%;outline:none;border:none;' value='$code' readonly>
        <br>
        <br>
        <span>Username</span>
        <input style='width:50%;outline:none;border:none;' value='$teacherUserName' readonly> ");
      $emailSender->setHeader("Admin Verification Code Is");
      $emailStatus = $emailSender->sendEmail();

      $query->addVerificationCode($teacherID, $code);
      
    } else {
    }
  }
} else {
}
