<?php
include "aiyo-config.php";
session_start();

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
  <title>Status Pembayaran Tiket</title>
  <link rel="apple-touch-icon" sizes="180x180" href="/goldenphoenix/assets/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/goldenphoenix/assets/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/goldenphoenix/assets/favicon-16x16.png">
  <link rel="manifest" href="/goldenphoenix/manifest.json">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg mx-auto">

    <div class="bg-gray-200 text-gray-800 p-6 rounded-lg shadow-md border-l-4 mb-6">
      <div class="flex items-center mb-4">
        <?php if ($status == "NEW") : ?>
          <i class="fas fa-exclamation-triangle text-yellow-600 text-4xl"></i>
          <h1 class="text-3xl font-bold ml-4">Invoice Baru</h1>
        <?php elseif ($status == "PAID") : ?>
          <i class="fas fa-check-circle text-green-600 text-4xl"></i>
          <h1 class="text-3xl font-bold ml-4">Pembayaran Berhasil</h1>
        <?php endif; ?>
      </div>

      <?php if ($status == "NEW") : ?>
        <p class="text-lg mb-4"><i class="fas fa-file-invoice"></i> Invoice: <?= htmlspecialchars($cekInvoice->responseData->invoiceName); ?></p>
        <?php if (isset($cekInvoice->responseData->items) && is_array($cekInvoice->responseData->items)) : ?>
          <ul class="mt-2 mb-4">
            <?php foreach ($cekInvoice->responseData->items as $item) : ?>
              <li class="text-lg"><i class="fas fa-ticket-alt"></i> Jenis Tiket: <?= htmlspecialchars($item->itemName); ?></li>
              <li class="text-lg"><i class="fas fa-sort-numeric-up-alt"></i> Jumlah Tiket: <?= htmlspecialchars($item->itemCount); ?></li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
        <p class="text-lg mb-2"><i class="fas fa-money-bill-wave"></i> Senilai: Rp <?= number_format($cekInvoice->responseData->payAmount, 0, ',', '.'); ?></p>
        <p class="text-lg mb-2"><i class="fas fa-user"></i> Nama: <?= htmlspecialchars($cekInvoice->responseData->userName); ?></p>
        <p class="text-lg mb-2"><i class="fas fa-envelope"></i> Email: <?= htmlspecialchars($cekInvoice->responseData->userEmail); ?></p>
        <p class="text-lg mb-2"><i class="fas fa-sticky-note"></i> Catatan: <?= !empty($cekInvoice->responseData->remarks) ? htmlspecialchars($cekInvoice->responseData->remarks) : '-'; ?></p>
        <p class="text-lg mb-4"><i class="fas fa-hourglass-half"></i> Status: Menunggu Pembayaran</p>

        <div class="flex justify-center mt-6">
          <a href="<?= htmlspecialchars($cekInvoice->responseData->invoiceURL); ?>" target="_blank" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out">
            <i class="fas fa-credit-card"></i> Lanjutkan Pembayaran
          </a>
        </div>
      <?php elseif ($status == "PAID") : ?>
        <p class="text-lg mb-4"><i class="fas fa-smile"></i> Terima kasih, pembayaran Anda telah berhasil.</p>
        <p class="text-lg">Silahkan cek email Anda untuk mendapat invoice!</p>
      <?php endif; ?>
    </div>
  </div>

</body>
</html>
