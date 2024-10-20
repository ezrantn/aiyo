<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require "../phpqrcode/qrlib.php";

include "../db-config.php";

$mail = new PHPMailer(true);

$env = parse_ini_file("../.env");

session_start();

echo $_SESSION['referenceId'];
$referenceId = $_SESSION['referenceId'];

$sql = "SELECT * FROM transaksi WHERE referenceId = '" . $referenceId . "'";

$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_array($result);

    $tempDir = sys_get_temp_dir();
    $qrFilePath = $tempDir . '/qrcode_' . $referenceId . '.png';

    if (QRcode::png($referenceId, $qrFilePath, QR_ECLEVEL_L, 4)) {
        echo "QR code generated at " . $qrFilePath;
    } else {
        echo "Failed to generate QR code";
    }

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = $env["MAIL_USERNAME"];
        $mail->Password   = $env["SMTP_PASSWORD"];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom($env["MAIL_USERNAME"], "Golden Phoenix Basketball");
        $mail->addAddress($row['userEmail'], $row['userName']);
        $mail->addReplyTo($env["MAIL_USERNAME"], "Golden Phoenix Basketball");
        $mail->addCC($env["MAIL_CC"]);
        $mail->addBCC($env["MAIL_CC"]);

        $mail->addEmbeddedImage($qrFilePath, 'qrcode_'.$referenceId, 'qrcode_'.$referenceId.'.png');

        $mail->isHTML(true);
        $mail->Subject = 'Payment Confirmation and Event Ticket';

        ob_start();
        include 'template.php';
        $emailBody = ob_get_clean();
        $mail->Body = $emailBody;
        $mail->AltBody = 'Your payment was successful. Reference ID: ' . $referenceId;

        $mail->send();
    } catch (Exception $e) {
        $errorMessage = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $myfile = fopen("email_error.txt", "a") or die("Unable to open file!");
        fwrite($myfile, $errorMessage . "\n");
        fclose($myfile);
    } finally {
        if (file_exists($qrFilePath)) {
            unlink($qrFilePath);
        }
    }
} else {
    echo "Error in SQL query: " . mysqli_error($conn);
}
