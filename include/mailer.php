<?php

require_once '../include/Exception.php';
require_once '../include/PHPMailer.php';
require_once '../include/SMTP.php';
define('PROJE_NAME', 'Online Pet Shop System');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($subject, $mailBody, $toAddress) {

    try {

        $mail = new PHPMailer(true);

//        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'shamani012345@gmail.com';                 // SMTP username
        $mail->Password = 'shavi@2020';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
        $mail->Port = 587;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->From = 'shamani012345@gmail.com';
        $mail->FromName = PROJE_NAME;
        $mail->addAddress($toAddress, '');

        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $mailBody;
        $mail->AltBody = $mailBody;

        if (!$mail->send()) {
            throw new Exception('Message could not be sent.: ' . $mail->ErrorInfo);
        } else {
            return true;
        }
    } catch (\Exception $ex) {
        throw $ex;
    }
}
