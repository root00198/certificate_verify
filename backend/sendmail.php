<?php

  include_once('PHPMailer/Exception.php');
  include_once('PHPMailer/PHPMailer.php');
  include_once('PHPMailer/SMTP.php');

   // Static Data
   $mail = new PHPMailer\PHPMailer\PHPMailer();
   $mail->IsSMTP(); // enable SMTP
   //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
   //authentication SMTP enabled
   $mail->SMTPAuth = true; 
   $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
   $mail->Host = "mail.ruskilled.com";
   $mail->Port = 465; 
   $mail->Username = "naman@ruskilled.com";
   $mail->Password = "naman@001";
   $mail->setFrom('naman@ruskilled.com', 'Naman');
   // Dynamic Data

   $mail->Subject = "Test";
   $msj="My complete message";
   $mail->MsgHTML($msj);
   $mail->AddAddress("naman00198@gmail.com");
   //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');

   if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
   } else {
      echo "Message has been sent";
   }
?>
