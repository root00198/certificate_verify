<?php

    include_once('PHPMailer/Exception.php');
    include_once('PHPMailer/PHPMailer.php');
    include_once('PHPMailer/SMTP.php');
    function sendcertificate($mail,$email,$certificate,$folder='../bulkdownload/')
    {
      $mail->Subject = "Certificate";
      $msj="My complete message";
      $mail->MsgHTML($msj);
      $mail->AddAddress($email);
      $mail->addAttachment($folder.$certificate.'.png', $certificate.'.png');
      $val = $mail->Send();
      $mail->clearAttachments();
      return $val;
    }

    function sendadmitcard()
    {

    }

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "mail.ruskilled.com";
    $mail->Port = 465; 
    $mail->Username = "naman@ruskilled.com";
    $mail->Password = "naman@001";
    $mail->setFrom('naman@ruskilled.com');

?>