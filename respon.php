<?php

include "token.php";

date_default_timezone_set('Asia/Jakarta');
$expireTime = date('Y-m-d\TH:i', strtotime('+10 hours'));


$bodyCreateInvoice = array(
    "invoiceName" => "Golden Phoenix",
    "referenceId" => "YPD" . date("mdHis"),
    "userName" => "Ridwan Sanjaya",
    "userEmail" => "ridwan@unika.ac.id",
    "userPhone" => "0818000000",
    "remarks" => "-",
    "payAmount" => 50000,
    "expireTime" => $expireTime,
    "billMasterId" => $billMasterId,
    "paymentMethod" => array(
        "type" => "VA_CLOSED",
        "bankCode" => "022"
    ),
    "items" => array(
        array(
            "itemName" => "Barang 1",
            "itemType" => "ITEM",
            "itemCount" => "1",
            "itemTotalPrice" => "10000"
        ),
        array(
            "itemName" => "Barang 2",
            "itemType" => "ITEM",
            "itemCount" => "2",
            "itemTotalPrice" => "20000"
        )
    )
);

//Signature
$pathInvoice = '/api/v1/invoice';
$urlCreateInvoice = $host . $pathInvoice;
$signRelativeURLCreateInvoice = parse_url($urlCreateInvoice, PHP_URL_PATH);
$rawBodyCreateInvoice = json_encode($bodyCreateInvoice);
$dataToSignCreateInvoice = $api_key . $signRelativeURLCreateInvoice . $rawBodyCreateInvoice;
$signatureCreateInvoice = hash_hmac('sha256', $dataToSignCreateInvoice, $api_secret);
$chCreateInvoice = curl_init($urlCreateInvoice);
$headersCreateInvoice = array(
"Content-Type: application/json",
"Authorization: Bearer ". $accessToken,
"x-aiyo-key: " . $api_key,
"x-aiyo-signature: " . $signatureCreateInvoice
);
curl_setopt($chCreateInvoice, CURLOPT_TIMEOUT, 30);
curl_setopt($chCreateInvoice, CURLOPT_POST, 1);
curl_setopt($chCreateInvoice, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($chCreateInvoice, CURLOPT_HTTPHEADER, $headersCreateInvoice);
curl_setopt($chCreateInvoice, CURLOPT_POSTFIELDS, $rawBodyCreateInvoice);
$sentHeaders = curl_getinfo($chCreateInvoice, CURLINFO_HEADER_OUT);
$responseCreateInvoice = curl_exec($chCreateInvoice);

$invoice=json_decode($responseCreateInvoice);
 if($invoice->responseCode=='2000000') {
 $invoiceId=$invoice->responseData->invoiceId;
 $accessToken=$invoice->responseData->accessToken;
 include "db_config.php";
 $sql = "INSERT INTO `transaksi` (`referenceId`, `userName`, `userEmail`, `userPhone`, `remarks`, `payAmount`,
`items`, `invoiceId`, `status`, `timestamp`) VALUES ('".$_POST['referenceId']."', '".$_POST['userName']."',
'".$_POST['userEmail']."', '".$_POST['userPhone']."', '".str_replace( array( '\'', '"', ',' , ';', '<', '>', '/' ), ' ', $remarks)."',
'".$_POST['payAmount']."', '".$detail."', '".$invoiceId."', 'NEW', current_timestamp())";

 if ($conn->query($sql) === TRUE) {
 //echo "Data inserted successfully";
 } else {
 echo "Error: " . $sql . "<br>" . $conn->error;
 }

 // Close connection
 $conn->close();
 }
 curl_close($chCreateInvoice);
 echo "Invoice ID: ". $invoiceId." Access Token: ". $accessToken;

?>
