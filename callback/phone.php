<?php

$curl = curl_init();
$env = parse_ini_file("../.env");

date_default_timezone_set('Asia/Jakarta');

$targetPhone = $_SESSION['userPhone'];
$message = 'Hello ' . $_SESSION['userName'] . ",\n\n";
$message .= "We have successfully received your payment of " . $_SESSION['payAmount'] . ".\n";
$message .= "Transaction Reference: " . $_SESSION['referenceId'] . "\n";
$message .= "Payment Date: " . date('Y-m-d H:i:s') . " WIB\n";
$message .= "Thank you for your purchase! If you have any questions, feel free to contact us.\n\n";
$message .= "Best regards,\nGolden Phoenix";

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.fonnte.com/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array(
        'target' => $targetPhone,
        'message' => $message,
        'countryCode' => '62',
    ),
    CURLOPT_HTTPHEADER => array(
        'Authorization: ' . $env["WA_AUTH"]
    ),
));

$response = curl_exec($curl);
if (curl_errno($curl)) {
    $error_msg = curl_error($curl);
}
curl_close($curl);

if (isset($error_msg)) {
    echo $error_msg;
}
echo $response;
