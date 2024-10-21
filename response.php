<?php
include "token.php";

session_start();

date_default_timezone_set('Asia/Jakarta');
$env = parse_ini_file(".env");

$userName = $_POST['userName'];
$userEmail = $_POST['userEmail'];
$userPhone = $_POST['userPhone'];
$remarks = $_POST['remarks'];

$userPhone = str_replace("-", "", $userPhone);
$referenceId = "GP2024" . date("mdHis");
$expireTime = date('Y-m-d\TH:i', strtotime('+3 hours'));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticketType = $_POST['ticketType'];
    $quantity = (int)$_POST['quantity'];

    $vipPrice = 16000;
    $nonVipPrice = 11000;
    $payAmount = 0;

    if ($ticketType == 'Premium') {
        $payAmount = $vipPrice * $quantity;
    } elseif ($ticketType == 'Reguler') {
        $payAmount = $nonVipPrice * $quantity;
    }
} else {
    echo "No data submitted.";
}

$bodyCreateInvoice = array(
    "invoiceName" => "Golden Phoenix Nusaputera",
    "referenceId" => $referenceId,
    "userName" => $userName,
    "userEmail" => $userEmail,
    "userPhone" => $userPhone,
    "remarks" => $remarks,
    "payAmount" => $payAmount,
    "expireTime" => $expireTime,
    "billMasterId" => $env["BILL_MASTER_ID"],
    "paymentMethod" => array(
        "type" => "VA_CLOSED",
        "bankCode" => "022"
    ),
    "items" => array(
        array(
            "itemName" => ucfirst($ticketType) . " Ticket",
            "itemType" => "ITEM",
            "itemCount" => $quantity,
            "itemTotalPrice" => $payAmount,
        ),
    )
);

$pathInvoice = '/api/v1/invoice';
$urlCreateInvoice = $host . $pathInvoice;
$signRelativeURLCreateInvoice = parse_url($urlCreateInvoice, PHP_URL_PATH);
$rawBodyCreateInvoice = json_encode($bodyCreateInvoice);
$dataToSignCreateInvoice = $api_key . $signRelativeURLCreateInvoice . $rawBodyCreateInvoice;
$signatureCreateInvoice = hash_hmac('sha256', $dataToSignCreateInvoice, $api_secret);

$chCreateInvoice = curl_init($urlCreateInvoice);
$headersCreateInvoice = array(
    "Content-Type: application/json",
    "Authorization: Bearer " . $accessToken,
    "x-aiyo-key: " . $api_key,
    "x-aiyo-signature: " . $signatureCreateInvoice
);
curl_setopt($chCreateInvoice, CURLOPT_TIMEOUT, 30);
curl_setopt($chCreateInvoice, CURLOPT_POST, 1);
curl_setopt($chCreateInvoice, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($chCreateInvoice, CURLOPT_HTTPHEADER, $headersCreateInvoice);
curl_setopt($chCreateInvoice, CURLOPT_POSTFIELDS, $rawBodyCreateInvoice);

$responseCreateInvoice = curl_exec($chCreateInvoice);
$invoice = json_decode($responseCreateInvoice);

if ($invoice->responseCode == '2000000') {
    $invoiceId = $invoice->responseData->invoiceId;
    $accessToken = $invoice->responseData->accessToken;

    include "db-config.php";

    $remarks = str_replace(array("'", '"', ',', ';', '<', '>', '/'), ' ', "-");

    $sql = "INSERT INTO transaksi
    (referenceId, userName, userEmail, userPhone, remarks, payAmount, items, invoiceId, status, timestamp, match_location)
    VALUES
    ('" . $referenceId . "', '" . $userName . "', '" . $userEmail . "', '" . $userPhone . "',
    '" . $remarks . "', '" . $payAmount . "', '" . $ticketType . "', '" . $invoiceId . "', 'NEW', current_timestamp(), '$match_location')";

    if ($conn->query($sql) === TRUE) {
        // Data inserted successfully, proceed with displaying the next step
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

curl_close($chCreateInvoice);

header("Location: check?invoiceId=$invoiceId&accessToken=$accessToken");
