<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Invoice and Ticket</title>
</head>

<body style="background-color: #f7fafc; padding: 2rem; font-family: sans-serif;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #fff; box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 2rem; margin-bottom: 1.5rem;">
        <h1 style="font-size: 24px; font-weight: bold; color: #4a5568; border-bottom: 2px solid #cbd5e0; padding-bottom: 1rem; margin-bottom: 1.5rem;">Invoice Pembayaran Basket</h1>
        <div style="display: flex; justify-content: space-between; margin-bottom: 1.5rem;">
            <div>
                <p style="font-size: 18px; font-weight: 600; color: #4a5568;">Nama: <span style="font-weight: 400;"><?php echo htmlspecialchars($row['userName']); ?></span></p>
                <p style="font-size: 18px; font-weight: 600; color: #4a5568;">Email: <span style="font-weight: 400;"><?php echo htmlspecialchars($row['userEmail']); ?></span></p>
                <p style="font-size: 18px; font-weight: 600; color: #4a5568;">Nomor Telepon: <span style="font-weight: 400;"><?php echo htmlspecialchars($row['userPhone']); ?></span></p>
                <p style="font-size: 18px; font-weight: 600; color: #4a5568;">Jenis Tiket: <span style="font-weight: 400;"><?php echo htmlspecialchars($row['items']); ?></span></p>
                <p style="font-size: 18px; font-weight: 600; color: #4a5568;">Jumlah Yang Dibayarkan: <span style="font-weight: 400;"><?php echo htmlspecialchars($row['payAmount']); ?></span></p>
                <p style="font-size: 18px; font-weight: 600; color: #4a5568;">Tanggal: <span style="font-weight: 400;"><?php echo date('Y-m-d'); ?></span></p>
                <p style="font-size: 18px; font-weight: 600; color: #4a5568;">Invoice: <span style="font-weight: 400;"><?php echo htmlspecialchars($referenceId); ?></span></p>
            </div>
        </div>
        <p style="color: #718096;">Terimakasih atas pembayaran Anda. Selamat menonton pertandingan!</p>
        <div style="text-align: center; margin-top: 2rem;">
            <h2 style="font-size: 20px; font-weight: bold; color: #4a5568;">Scan QR Code to view details:</h2>
            <img src="cid:qrcode_<?php echo $referenceId; ?>" alt="QR Code">
        </div>
    </div>
</body>

</html>
