<?php
include "../db-config.php";

// Check if the ID is provided
if (!isset($_GET['id'])) {
    header("Location: register-history"); // Redirect if no ID is provided
    exit();
}

$id = $_GET['id'];

// Fetch the record to edit
$query = "SELECT * FROM pendaftaran WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: register-history"); // Redirect if the record is not found
    exit();
}

$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update the record
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $asal_sekolah = $_POST['asal_sekolah'];
    $alasan = $_POST['alasan'];

    $update_query = "UPDATE pendaftaran SET nama=?, email=?, nomor_telepon=?, asal_sekolah=?, alasan=? WHERE id=?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sssssi", $nama, $email, $nomor_telepon, $asal_sekolah, $alasan, $id);

    if ($update_stmt->execute()) {
        header("Location: register-history?msg=Record updated successfully");
        exit();
    } else {
        $error = "Failed to update the record.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record | Golden Phoenix</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/goldenphoenix/assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/goldenphoenix/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/goldenphoenix/assets/favicon-16x16.png">
    <link rel="manifest" href="/goldenphoenix/manifest.json">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div id="dashboard" class="flex flex-col md:flex-row min-h-screen">
        <div class="w-full md:w-64 bg-gray-800 shadow-xl p-6 h-full text-white">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">Admin Dashboard</h2>
                <img src="/goldenphoenix/assets/logo.png" alt="Logo" class="w-10 h-10 rounded-full">
            </div>

            <ul class="space-y-4">
                <li>
                    <a href="./dashboard" class="flex items-center space-x-3 p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3 9.75v7.5c0 1.379 1.12 2.5 2.5 2.5h13c1.38 0 2.5-1.121 2.5-2.5v-7.5"></path><path d="M21 9.75v-3.5a2.5 2.5 0 00-2.5-2.5h-13A2.5 2.5 0 003 6.25v3.5"></path></svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="./register-history" class="flex items-center space-x-3 p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 8v4m0 4h.01"></path><path d="M21 16.05A9.9 9.9 0 0012.15 3H12a9.9 9.9 0 00-9.9 9.9v.1a9.9 9.9 0 009.9 9.9h.15A9.9 9.9 0 0021 16.05z"></path></svg>
                        <span>List Pendaftaran Member</span>
                    </a>
                </li>
                <li>
                    <a href="./tuition-history" class="flex items-center space-x-3 p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 8v4m0 4h.01"></path><path d="M21 16.05A9.9 9.9 0 0012.15 3H12a9.9 9.9 0 00-9.9 9.9v.1a9.9 9.9 0 009.9 9.9h.15A9.9 9.9 0 0021 16.05z"></path></svg>
                        <span>List Pembayaran SPP Member</span>
                    </a>
                </li>
                <li>
                    <a href="./manage-matches" class="flex items-center space-x-3 p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 8v4m0 4h.01"></path><path d="M21 16.05A9.9 9.9 0 0012.15 3H12a9.9 9.9 0 00-9.9 9.9v.1a9.9 9.9 0 009.9 9.9h.15A9.9 9.9 0 0021 16.05z"></path></svg>
                        <span>Atur Jadwal Pertandingan</span>
                    </a>
                </li>
                <li>
                    <a href="./log-out.php" class="flex items-center space-x-3 p-3 bg-red-500 rounded-lg hover:bg-red-600 transition duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17 16l4-4m0 0l-4-4m4 4H7"></path><path d="M12 19H5a2 2 0 01-2-2V7a2 2 0 012-2h7"></path></svg>
                        <span>Log Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-grow p-6 md:p-10">
            <h1 class="text-3xl font-extrabold mb-8 text-gray-800">Edit Member</h1>

            <div class="bg-white shadow-lg rounded-lg p-8 mb-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Details</h2>

                <?php if (isset($error)): ?>
                    <p class="text-red-500 mb-4"><?php echo $error; ?></p>
                <?php endif; ?>

                <form action="" method="POST">
                    <div class="mb-4">
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                    </div>
                    <div class="mb-4">
                        <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" id="nomor_telepon" name="nomor_telepon" value="<?php echo htmlspecialchars($row['nomor_telepon']); ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                    </div>
                    <div class="mb-4">
                        <label for="asal_sekolah" class="block text-sm font-medium text-gray-700">Asal Sekolah</label>
                        <input type="text" id="asal_sekolah" name="asal_sekolah" value="<?php echo htmlspecialchars($row['asal_sekolah']); ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md" />
                    </div>
                    <div class="mb-4">
                        <label for="alasan" class="block text-sm font-medium text-gray-700">Alasan</label>
                        <textarea id="alasan" name="alasan" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md"><?php echo htmlspecialchars($row['alasan']); ?></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 transition-colors duration-200">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
