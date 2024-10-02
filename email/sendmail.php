<?php
$env = parse_ini_file("../.env");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

session_start();

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
    $mail->isSMTP();                                            
    $mail->Host       = $env["MAIL_HOST"];                   
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = $env["MAIL_USERNAME"];                     
    $mail->Password   = $env["MAIL_PASSWORD"];                              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                   

    $mail->setFrom($env["MAIL_USERNAME"], 'Golden Phoenix Basketball');
    $mail->addAddress($_SESSION["userEmail"], $_SESSION["userName"]);     

    $mail->isHTML(true);                                  
    $mail->Subject = 'Payment Confirmation for Invoice ' . $_SESSION['referenceId'];

    $mail->Body    = '
    <h1>Payment Confirmation</h1>
    <p>Dear ' . $_SESSION['userName'] . ',</p>
    <p>Your payment of <b>' . $_SESSION['payAmount'] . '</b> for Invoice ID <b>' . $_SESSION['referenceId'] . '</b> has been successfully processed.</p>
    <p>Details: ' . $_SESSION['detail'] . '</p>
    <p>Remarks: ' . $_SESSION['remarks'] . '</p>
    <p>Thank you for your payment.</p>
    <p>Best regards,<br>Payment System Team</p>';
    
    $mail->AltBody = 'Dear ' . $_SESSION['userName'] . ', Your payment of ' . $_SESSION['payAmount'] . ' for Invoice ID ' . $_SESSION['referenceId'] . ' has been successfully processed.';

    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>