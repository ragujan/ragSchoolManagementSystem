<?php
session_start();
if (isset($_POST["email"])  && isset($_POST["password"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];


  require_once "../../inputValidations/ValidateInputs.php";

  $validation = new ValidateInputs();
  $emailVali = $validation->mailVali($email);
  if (!$emailVali) {
    exit("Not a Valid Email");
  }
  require_once "../../academic/academicQuery/academicQuery.php";
  $query = new AcademicQuery();

  $academicDetails = $query->getacademicDetails($email);
  $academicID = $academicDetails[0][0];
  $academicUserName = $academicDetails[0][1];
  $academicCheck = $query->academicCheckEnP($email, $password);
  if ($academicCheck == true) {
    $_SESSION["academic_session_mail"] = $email;
    $checkVerifyCodeacademic = $query->checkVerificationCodebyemail($email);
    if (!$checkVerifyCodeacademic) {
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
        <input style='width:50%;outline:none;border:none;' value='$academicUserName' readonly> ");
      $emailSender->setHeader("Admin Verification Code Is");
      $emailStatus = $emailSender->sendEmail();

      $query->addVerificationCode($academicID, $code);
    } else {
    }
  }
} else {
}
