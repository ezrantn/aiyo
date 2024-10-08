<?php

$curl = curl_init();
$env = parse_ini_file("../.env");

date_default_timezone_set('Asia/Jakarta');

$targetPhone = $_SESSION['userPhone'];
$message = 'Halo ' . $_SESSION['userName'] . ",\n\n";
$message .= "Sukses melakukan pembayaran sebesar: " . "Rp. " . $_SESSION['payAmount'] . ".\n\n";
$message .= "Reference ID Anda: " . $_SESSION['referenceId'] . "\n";
$message .= "Tanggal Pembayaran: " . date('Y-m-d H:i:s') . " WIB\n\n";
$message .= "Terimakasih telah melakukan pembayaran!\n\n";
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
        'Authorization: ' . $env["FONNTE_TOKEN"]
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
