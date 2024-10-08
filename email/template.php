<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Invoice and Ticket</title>
</head>
<body style="background-color: #f7fafc; padding: 2rem; font-family: sans-serif;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #fff; box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 2rem; margin-bottom: 1.5rem;">
        <h1 style="font-size: 24px; font-weight: bold; color: #4a5568; border-bottom: 2px solid #cbd5e0; padding-bottom: 1rem; margin-bottom: 1.5rem;">Payment Invoice</h1>
        <div style="display: flex; justify-content: space-between; margin-bottom: 1.5rem;">
            <div>
                <p style="font-size: 18px; font-weight: 600; color: #4a5568;">Customer: <span style="font-weight: 400;"><?php echo htmlspecialchars($row['userName']); ?></span></p>
                <p style="font-size: 18px; font-weight: 600; color: #4a5568;">Email: <span style="font-weight: 400;"><?php echo htmlspecialchars($row['userEmail']); ?></span></p>
            </div>
            <div>
                <p style="font-size: 18px; font-weight: 600; color: #4a5568;">Date: <span style="font-weight: 400;"><?php echo date('Y-m-d'); ?></span></p>
                <p style="font-size: 18px; font-weight: 600; color: #4a5568;">Invoice #: <span style="font-weight: 400;">INV-<?php echo htmlspecialchars($referenceId); ?></span></p>
            </div>
        </div>
        <p style="color: #718096;">Thank you for your payment. Your transaction was successful.</p>
    </div>

    <div style="max-width: 600px; margin: 0 auto; background-image: linear-gradient(to right, #c3dafe, #ebf8ff); border-radius: 8px; box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); padding: 2rem;">
        <h2 style="font-size: 20px; font-weight: 600; color: #2d3748; margin-bottom: 1rem;">Golden Phoenix Basketball Event Ticket</h2>
        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
            <span style="font-weight: bold; color: #4a5568;">Event: </span>
            <span style="color: #4a5568;">Basketball Tournament</span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
            <span style="font-weight: bold; color: #4a5568;">Date:</span>
            <span style="color: #4a5568;"><?php echo date('F d, Y'); ?></span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
            <span style="font-weight: bold; color: #4a5568;">Venue:</span>
            <span style="color: #4a5568;">Phoenix Arena</span>
        </div>
        <div style="background-color: #4299e1; color: #fff; font-weight: bold; text-align: center; padding: 1rem; border-radius: 4px; font-size: 18px;">
            Reference ID: <?php echo htmlspecialchars($referenceId); ?>
        </div>
    </div>
</body>
</html>
