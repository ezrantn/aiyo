<?php
include "./db-config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form OTP</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/goldenphoenix/assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/goldenphoenix/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/goldenphoenix/assets/favicon-16x16.png">
    <link rel="manifest" href="/goldenphoenix/manifest.json">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form method="POST" action="./callback/otp" accept-charset="utf-8" class="bg-white shadow-lg rounded-lg w-full max-w-md p-8">
        <h1 class="text-center text-2xl font-bold mb-6 text-gray-900">Verifikasi OTP</h1>

        <div class="<?php echo isset($_POST['submit-otp']) ? 'hidden' : 'flex' ?> flex-col mb-6">
            <label for="nomor" class="text-left mb-2 font-medium text-gray-700">Nomor Telepon</label>
            <input placeholder="081xxxxx" name="nomor" type="text" id="nomor" class="p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 w-full" required <?php if (isset($_POST['submit-otp'])) { echo "value='$nomor' hidden"; } ?> />
        </div>

        <?php if (isset($_POST['submit-otp'])) { ?>
            <div class="flex flex-col mb-6">
                <label for="otp" class="text-left mb-2 font-medium text-gray-700">Enter OTP Code</label>
                <input placeholder="xxxxxx" name="otp" type="text" id="otp" class="p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 w-full" />
            </div>
        <?php } ?>

        <div class="text-center">
            <?php if (!isset($_POST['submit-otp'])) { ?>
                <button type="submit" id="btn-otp" class="bg-black hover:bg-gray-900 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 w-full" name="submit-otp">Kirim</button>
            <?php } ?>

            <?php if (isset($_POST['submit-otp'])) { ?>
                <button type="submit" id="btn-login" class="bg-black hover:bg-gray-900 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200 w-full" name="submit-login">Verify OTP</button>
            <?php } ?>
        </div>
    </form>
</body>

</html>
