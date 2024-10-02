<?php
include "aiyo_config.php";

$pathInvoice = '/api/v1/invoice';
$invoiceId = $_GET['invoiceId'];
$accessToken = $_GET['accessToken'];
$URLCekStatus = $host . $pathInvoice . "/" . $invoiceId . "?accessToken=" . $accessToken;

$chCekInvoice = curl_init($URLCekStatus);
curl_setopt($chCekInvoice, CURLOPT_TIMEOUT, 30);
curl_setopt($chCekInvoice, CURLOPT_RETURNTRANSFER, true);
$responseCekInvoice = curl_exec($chCekInvoice);
curl_close($chCekInvoice);

$cekInvoice = json_decode($responseCekInvoice);
$status = $cekInvoice->responseData->invoiceStatus;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Status Pembayaran</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gradient-to-r from-blue-500 to-indigo-500 flex items-center justify-center min-h-screen">
  <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg mx-auto transform transition duration-500 hover:scale-105">
    <?php if ($status == "NEW") : ?>
      <div class="bg-red-100 text-red-700 p-6 rounded-lg shadow-md border-l-4 border-red-500 mb-6">
        <div class="flex items-center mb-4">
          <i class="fas fa-exclamation-triangle text-red-500 text-3xl"></i>
          <h1 class="text-3xl font-bold ml-4">Invoice Baru</h1>
        </div>
        <p class="text-lg"><i class="fas fa-file-invoice"></i> Invoice: <?= htmlspecialchars($cekInvoice->responseData->invoiceName); ?></p>

        <?php if (isset($cekInvoice->responseData->items) && is_array($cekInvoice->responseData->items)) : ?>
          <ul class="mt-2">
            <?php foreach ($cekInvoice->responseData->items as $item) : ?>
              <li class="text-lg"><i class="fas fa-ticket-alt"></i> Jenis Tiket: <?= htmlspecialchars($item->itemName); ?></li>
              <li class="text-lg"><i class="fas fa-sort-numeric-up-alt"></i> Jumlah Tiket: <?= htmlspecialchars($item->itemCount); ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <p class="text-lg mt-2"><i class="fas fa-money-bill-wave"></i> Senilai: Rp <?= number_format($cekInvoice->responseData->payAmount, 0, ',', '.'); ?></p>
        <p class="text-lg"><i class="fas fa-user"></i> Nama: <?= htmlspecialchars($cekInvoice->responseData->userName); ?></p>
        <p class="text-lg"><i class="fas fa-envelope"></i> Email: <?= htmlspecialchars($cekInvoice->responseData->userEmail); ?></p>
        <p class="text-lg"><i class="fas fa-sticky-note"></i> Catatan: <?= !empty($cekInvoice->responseData->remarks) ? htmlspecialchars($cekInvoice->responseData->remarks) : '-'; ?></p>
        <p class="text-lg"><i class="fas fa-hourglass-half"></i> Status: Menunggu Pembayaran</p>
      </div>
      
      <div class="flex justify-center mt-6">
        <a href="<?= htmlspecialchars($cekInvoice->responseData->invoiceURL); ?>" target="_blank" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out">
          <i class="fas fa-credit-card"></i> Lanjutkan Pembayaran
        </a>
      </div>

    <?php elseif ($status == "PAID") : ?>
      <div class="bg-green-100 text-green-700 p-6 rounded-lg shadow-md border-l-4 border-green-500 mb-6">
        <div class="flex items-center mb-4">
          <i class="fas fa-check-circle text-green-500 text-3xl"></i>
          <h1 class="text-3xl font-bold ml-4">Pembayaran Berhasil</h1>
        </div>
        <p class="text-lg"><i class="fas fa-smile"></i> Terima kasih, pembayaran Anda telah berhasil.</p>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
