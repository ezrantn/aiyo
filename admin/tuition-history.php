<?php
if(isset($_GET['chart_data'])) {
    include "../db-config.php";

    $sql = "SELECT payment_method, COUNT(*) as count
            FROM pembayaran
            WHERE status = 'PAID'
            GROUP BY payment_method";
    $result = $conn->query($sql);

    $data = [];
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Phoenix | List Pembayaran SPP Member</title>
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

        <div class="flex-grow p-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="px-4 py-3 bg-gray-800 text-white">
                    <h2 class="text-lg font-semibold">List Pembayaran SPP Member</h2>
                </div>
                <?php
                include "../db-config.php";

                $limit = 10;
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $limit;

                $total_sql = "SELECT COUNT(*) FROM pembayaran WHERE status = 'PAID'";
                $total_result = $conn->query($total_sql);
                $total_rows = $total_result->fetch_row()[0];

                $total_pages = ceil($total_rows / $limit);

                $sql = "SELECT p.id, p.amount, p.payment_method, p.invoice_id, p.status, p.created_at, p.updated_at, d.nama
                FROM pembayaran p
                JOIN pendaftaran d ON CAST(p.user_id AS CHAR) = d.user_id
                WHERE p.status = 'PAID'
                ORDER BY p.updated_at DESC
                LIMIT $limit OFFSET $offset";

                $result = $conn->query($sql);

                if ($result->num_rows > 0):
                ?>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <th class="px-4 py-3">ID</th>
                                    <th class="px-4 py-3">Username</th>
                                    <th class="px-4 py-3">Jumlah</th>
                                    <th class="px-4 py-3">Metode Pembayaran</th>
                                    <th class="px-4 py-3">ID Invoice</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Tanggal Dibuat</th>
                                    <th class="px-4 py-3">Tanggal Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm"><?php echo htmlspecialchars($row['id']); ?></td>
                                        <td class="px-4 py-3 text-sm font-medium"><?php echo htmlspecialchars($row['nama']); ?></td>
                                        <td class="px-4 py-3 text-sm">Rp <?php echo number_format($row['amount'], 0, ',', '.'); ?></td>
                                        <td class="px-4 py-3 text-sm"><?php echo htmlspecialchars($row['payment_method']); ?></td>
                                        <td class="px-4 py-3 text-sm"><?php echo htmlspecialchars($row['invoice_id']); ?></td>
                                        <td class="px-4 py-3 text-sm font-medium text-green-600"><?php echo htmlspecialchars($row['status']); ?></td>
                                        <td class="px-4 py-3 text-sm"><?php echo htmlspecialchars($row['created_at']); ?></td>
                                        <td class="px-4 py-3 text-sm"><?php echo htmlspecialchars($row['updated_at']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 sm:px-6">
                        <div class="flex items-center justify-between">
                            <a
                                href="?page=<?php echo max(1, $page - 1); ?>"
                                class="px-3 py-1 bg-gray-800 text-white text-sm rounded hover:bg-gray-700 transition-colors duration-200 <?php if ($page == 1) echo 'opacity-50 cursor-not-allowed'; ?>">
                                Previous
                            </a>
                            <span class="text-sm text-gray-700">
                                Page <?php echo $page; ?> of <?php echo $total_pages; ?>
                            </span>
                            <a
                                href="?page=<?php echo min($total_pages, $page + 1); ?>"
                                class="px-3 py-1 bg-gray-800 text-white text-sm rounded hover:bg-gray-700 transition-colors duration-200 <?php if ($page == $total_pages) echo 'opacity-50 cursor-not-allowed'; ?>">
                                Next
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-red-500 text-center py-4">Belum ada pembayaran SPP yang lunas.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>


<?php
$conn->close();
?>
