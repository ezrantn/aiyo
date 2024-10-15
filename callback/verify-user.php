<?php
session_start();

include "../db-config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['otp'], $_POST['nomor'])) {
    $nomor = $_POST['nomor'];
    $otp = $_POST['otp'];

    $stmt = $conn->prepare("SELECT otp FROM otp WHERE nomor = ? ORDER BY waktu DESC LIMIT 1");
    $stmt->bind_param("s", $nomor);
    $stmt->execute();
    $stmt->bind_result($storedOtp);
    $stmt->fetch();
    $stmt->close();

    if ($storedOtp === $otp) {
        $stmt = $conn->prepare("SELECT user_id FROM pendaftaran WHERE nomor_telepon = ?");
        $stmt->bind_param("s", $nomor);
        $stmt->execute();
        $stmt->bind_result($user_id);
        $stmt->fetch();
        $stmt->close();

        if ($user_id) {
            $message = "OTP verified successfully. Your User ID: " . htmlspecialchars($user_id);
        } else {
            $message = "User not found for the provided phone number.";
        }
    } else {
        $message = "Invalid OTP.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/goldenphoenix/assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/goldenphoenix/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/goldenphoenix/assets/favicon-16x16.png">
    <link rel="manifest" href="/goldenphoenix/manifest.json">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" action="" class="bg-white shadow-lg rounded-lg w-full max-w-md p-8 space-y-6">
        <h1 class="text-center text-3xl font-bold text-teal-600 mb-4">Verifikasi OTP</h1>

        <div class="flex flex-col">
            <label for="nomor" class="text-left mb-2 font-medium text-gray-700">Nomor Telepon</label>
            <input type="text" name="nomor" id="nomor" value="<?php echo htmlspecialchars($_GET['nomor']); ?>" class="p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 w-full" readonly />
        </div>

        <div class="flex flex-col">
            <label for="otp" class="text-left mb-2 font-medium text-gray-700">Masukkan Kode OTP</label>
            <input type="text" name="otp" id="otp" class="p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 w-full" placeholder="123456" required />
        </div>

        <div class="text-center">
            <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 w-full" name="submit-login">Verifikasi OTP</button>
        </div>
    </form>
</body>
</html>
