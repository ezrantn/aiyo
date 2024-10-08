<?php
session_start();
include "token.php";
include "db-config.php";

date_default_timezone_set('Asia/Jakarta');
$env = parse_ini_file(".env");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $memberID = $_POST['memberID'];
    $category = $_POST['category'];

    $stmtUser = $conn->prepare("SELECT nama, email, nomor_telepon FROM pendaftaran WHERE user_id = ?");
    $stmtUser->bind_param("s", $memberID);
    $stmtUser->execute();
    $resultUser = $stmtUser->get_result();

    if ($resultUser->num_rows == 0) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Anggota ID Invalid',
                text: 'ID Anggota yang Anda masukkan salah',
            }).then(() => {
                window.history.back();
            });
        </script>";
        exit();
    }

    $userData = $resultUser->fetch_assoc();
    $userEmail = $userData['email'] ?? "";
    $userPhone = $userData['nomor_telepon'] ?? "";

    $referenceId = "GP2024" . date("mdHis");
    $expireTime = date('Y-m-d\TH:i', strtotime('+3 hours'));

    $payAmount = ($category == 'internal') ? 100000 : 150000;

    $bodyCreateInvoice = array(
        "invoiceName" => "Pembayaran SPP Golden Phoenix Basketball Team",
        "referenceId" => $referenceId,
        "userName" => $memberID,
        "userEmail" => $userEmail,
        "userPhone" => $userPhone,
        "remarks" => "",
        "payAmount" => $payAmount,
        "expireTime" => $expireTime,
        "billMasterId" => $env["BILL_MASTER_ID"],
        "paymentMethod" => array(
            "type" => "VA_CLOSED",
            "bankCode" => "022"
        ),
        "items" => array(
            array(
                "itemName" => "SPP " . ucfirst($category),
                "itemType" => "ITEM",
                "itemCount" => 1,
                "itemTotalPrice" => $payAmount
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

        $stmtTransaksi = $conn->prepare("INSERT INTO transaksi (referenceId, userName, payAmount, items, invoiceId, status, timestamp) VALUES (?, ?, ?, ?, ?, ?, current_timestamp())");
        $status = 'NEW';
        $items = 'SPP';

        $stmtTransaksi->bind_param("ssisss", $referenceId, $memberID, $payAmount, $items, $invoiceId, $status);

        if ($stmtTransaksi->execute()) {
            $stmtPembayaran = $conn->prepare("INSERT INTO pembayaran (user_id, amount, payment_method, invoice_id, status) VALUES (?, ?, ?, ?, 'pending')");
            $paymentMethod = "VA_CLOSED";

            $stmtPembayaran->bind_param("sdss", $memberID, $payAmount, $paymentMethod, $invoiceId);

            if ($stmtPembayaran->execute()) {
                header("Location: tuition-check.php?invoiceId=$invoiceId&accessToken=$accessToken");
                exit();
            } else {
                echo "Error inserting into pembayaran: " . $stmtPembayaran->error;
            }

            $stmtPembayaran->close();
        } else {
            echo "Error inserting into transaksi: " . $stmtTransaksi->error;
        }

        $stmtTransaksi->close();
    } else {
        echo "Error creating invoice: " . $invoice->responseMessage;
    }

    curl_close($chCreateInvoice);
    $conn->close();
} else {
    echo "Invalid request method.";
}
