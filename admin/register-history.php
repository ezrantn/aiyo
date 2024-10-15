<?php
include "../db-config.php";

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$total_sql = "SELECT COUNT(*) FROM pendaftaran";
$total_result = $conn->query($total_sql);
$total_rows = $total_result->fetch_row()[0];

$total_pages = ceil($total_rows / $limit);

$sql = "SELECT id, nama, email, nomor_telepon, asal_sekolah, alasan, is_membayar, created_at FROM pendaftaran LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Pendaftaran Member</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/goldenphoenix/assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/goldenphoenix/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/goldenphoenix/assets/favicon-16x16.png">
    <link rel="manifest" href="/goldenphoenix/manifest.json">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div id="dashboard" class="flex">
        <div class="w-64 bg-white shadow-md p-4">
            <h2 class="text-lg font-semibold mb-4">Admin Dashboard</h2>
            <ul>
                <li class="mb-2">
                    <a href="./dashboard.php" class="text-gray-700 hover:bg-gray-200 block p-2 rounded">Dashboard</a>
                </li>
                <li class="mb-2">
                    <a href="./log-out.php" class="text-gray-700 hover:bg-gray-200 block p-2 rounded">Log Out</a>
                </li>
            </ul>
        </div>

        <div class="flex-grow p-6">
            <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

            <div class="flex justify-end mb-4">
                <nav class="bg-white shadow-md rounded-lg">
                    <ul class="flex space-x-4 p-4">
                        <li>
                            <a href="./register-history.php" class="text-gray-700 hover:bg-gray-200 p-2 rounded">List Pendaftaran Member</a>
                        </li>
                        <li>
                            <a href="./tuition-history.php" class="text-gray-700 hover:bg-gray-200 p-2 rounded">List Pembayaran SPP Member</a>
                        </li>
                        <li>
                            <a href="./manage-matches.php" class="text-gray-700 hover:bg-gray-200 p-2 rounded">Atur Jadwal Pertandingan</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">List Pendaftaran Member</h2>

                <?php if ($result->num_rows > 0): ?>
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-200 text-left">
                                <th class="px-4 py-2 border">ID</th>
                                <th class="px-4 py-2 border">Nama</th>
                                <th class="px-4 py-2 border">Email</th>
                                <th class="px-4 py-2 border">Nomor Telepon</th>
                                <th class="px-4 py-2 border">Asal Sekolah</th>
                                <th class="px-4 py-2 border">Alasan</th>
                                <th class="px-4 py-2 border">Tanggal Pendaftaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr class="border-t">
                                    <td class="px-4 py-2 border"><?php echo $row['id']; ?></td>
                                    <td class="px-4 py-2 border"><?php echo $row['nama']; ?></td>
                                    <td class="px-4 py-2 border"><?php echo $row['email']; ?></td>
                                    <td class="px-4 py-2 border"><?php echo $row['nomor_telepon']; ?></td>
                                    <td class="px-4 py-2 border"><?php echo $row['asal_sekolah']; ?></td>
                                    <td class="px-4 py-2 border"><?php echo $row['alasan']; ?></td>
                                    <td class="px-4 py-2 border"><?php echo $row['created_at']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                    <div class="flex justify-between mt-4">
                        <a
                            href="?page=<?php echo max(1, $page - 1); ?>"
                            class="text-gray-700 bg-white hover:bg-gray-200 p-2 rounded <?php if ($page == 1) echo 'pointer-events-none opacity-50'; ?>">
                            Previous
                        </a>

                        <span class="text-gray-700">
                            Page <?php echo $page; ?> of <?php echo $total_pages; ?>
                        </span>

                        <a
                            href="?page=<?php echo min($total_pages, $page + 1); ?>"
                            class="text-gray-700 bg-white hover:bg-gray-200 p-2 rounded <?php if ($page == $total_pages) echo 'pointer-events-none opacity-50'; ?>">
                            Next
                        </a>
                    </div>
                <?php else: ?>
                    <p class="text-red-500">Belum ada pendaftaran member.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</body>
</html>


<?php
$conn->close();
?>
