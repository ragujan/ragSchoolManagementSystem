<?php
session_start();
if (isset($_POST["email"])  && isset($_POST["password"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  require_once "../../inputValidations/ValidateInputs.php";
  $validation = new ValidateInputs();
  $emailVali = $validation->mailVali($email);
  $passwordValid = $validation->emptyCheck($password);
  if (!$emailVali) {
    exit("Not a Valid Email");
  }
  if(!$passwordValid){
    exit("password is not valid");
  }


  require_once "../../student/studentQuery/studentQuery.php";
  $query = new StudentQuery();

  $studentDetails = $query->getstudentDetails($email);
  $studentID = $studentDetails[0][0];
  $studentUserName = $studentDetails[0][1];
  $studentCheck = $query->studentCheckEnP($email, $password);
  if ($studentCheck == true) {
    $_SESSION["student_session_mail"] = $email;
    $checkVerifyCodestudent = $query->checkVerificationCodebyemail($email);
    if (!$checkVerifyCodestudent) {
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
        <input style='width:50%;outline:none;border:none;' value='$studentUserName' readonly> ");
      $emailSender->setHeader("Admin Verification Code Is");
      $emailStatus = $emailSender->sendEmail();

      $query->addVerificationCode($studentID, $code);
    } else {
    }
  }
} else {
}
