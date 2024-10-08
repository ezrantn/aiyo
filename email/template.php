<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Invoice and Ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6 mb-6">
        <h1 class="text-3xl font-bold text-gray-700 border-b-2 border-gray-300 pb-4 mb-4">Payment Invoice</h1>
        <div class="flex justify-between mb-6">
            <div>
                <p class="text-lg font-semibold text-gray-700">Customer: <span class="font-normal"><?php echo htmlspecialchars($row['userName']); ?></span></p>
                <p class="text-lg font-semibold text-gray-700">Email: <span class="font-normal"><?php echo htmlspecialchars($row['userEmail']); ?></span></p>
            </div>
            <div>
                <p class="text-lg font-semibold text-gray-700">Date: <span class="font-normal"><?php echo date('Y-m-d'); ?></span></p>
                <p class="text-lg font-semibold text-gray-700">Invoice #: <span class="font-normal">INV-<?php echo htmlspecialchars($referenceId); ?></span></p>
            </div>
        </div>
        <p class="text-gray-600">Thank you for your payment. Your transaction was successful.</p>
    </div>

    <div class="max-w-2xl mx-auto bg-gradient-to-r from-blue-200 to-blue-300 rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Golden Phoenix Basketball Event Ticket</h2>
        <div class="flex justify-between mb-2">
            <span class="font-bold text-gray-700">Event: </span>
            <span class="text-gray-700">Basketball Tournament</span>
        </div>
        <div class="flex justify-between mb-2">
            <span class="font-bold text-gray-700">Date:</span>
            <span class="text-gray-700"><?php echo date('F d, Y'); ?></span>
        </div>
        <div class="flex justify-between mb-4">
            <span class="font-bold text-gray-700">Venue:</span>
            <span class="text-gray-700">Phoenix Arena</span>
        </div>
        <div class="bg-blue-500 text-white font-bold text-center py-3 rounded-md text-lg">
            Reference ID: <?php echo htmlspecialchars($referenceId); ?>
        </div>
    </div>
</body>
</html>