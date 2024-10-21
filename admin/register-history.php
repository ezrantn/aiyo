<?php
include "../db-config.php";

if (isset($_GET['chart_data']) && $_GET['chart_data'] == 1) {
    header('Content-Type: application/json');

    $query = "SELECT DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count
              FROM pendaftaran
              GROUP BY month
              ORDER BY month ASC";

    $result = $conn->query($query);
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
    exit();
}

// Pagination
$results_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $results_per_page;

// Query to get total number of rows
$total_query = "SELECT COUNT(*) as total FROM pendaftaran";
$total_result = $conn->query($total_query);
$total_rows = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $results_per_page);

// Query to get data for current page
$query = "SELECT * FROM pendaftaran ORDER BY created_at DESC LIMIT $offset, $results_per_page";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Phoenix | Admin Dashboard</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/goldenphoenix/assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/goldenphoenix/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/goldenphoenix/assets/favicon-16x16.png">
    <link rel="manifest" href="/goldenphoenix/manifest.json">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #paymentChart {
            max-width: 300px; /* Adjust size */
            margin: 0 auto;
        }
    </style>
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
                    <a href="./log-out" class="flex items-center space-x-3 p-3 bg-red-500 rounded-lg hover:bg-red-600 transition duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17 16l4-4m0 0l-4-4m4 4H7"></path><path d="M12 19H5a2 2 0 01-2-2V7a2 2 0 012-2h7"></path></svg>
                        <span>Log Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="flex-grow p-8">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="px-4 py-3 bg-gray-800 text-white">
                    <h2 class="text-lg font-semibold">Pendaftaran Anggota Baru</h2>
                </div>
                <?php if ($result->num_rows > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <th class="px-4 py-3">ID</th>
                                    <th class="px-4 py-3">Nama</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Nomor Telepon</th>
                                    <th class="px-4 py-3">Asal Sekolah</th>
                                    <th class="px-4 py-3">Alasan</th>
                                    <th class="px-4 py-3">Tanggal Pendaftaran</th>
                                    <th class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-sm"><?php echo htmlspecialchars($row['id']); ?></td>
                                        <td class="px-4 py-3 text-sm font-medium"><?php echo htmlspecialchars($row['nama']); ?></td>
                                        <td class="px-4 py-3 text-sm"><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td class="px-4 py-3 text-sm"><?php echo htmlspecialchars($row['nomor_telepon']); ?></td>
                                        <td class="px-4 py-3 text-sm"><?php echo htmlspecialchars($row['asal_sekolah']); ?></td>
                                        <td class="px-4 py-3 text-sm max-w-xs truncate"><?php echo htmlspecialchars($row['alasan']); ?></td>
                                        <td class="px-4 py-3 text-sm"><?php echo htmlspecialchars($row['created_at']); ?></td>
                                        <td class="px-4 py-3 text-sm space-x-2 whitespace-nowrap">
                                            <a href="edit?id=<?php echo $row['id']; ?>" class="text-gray-800 hover:text-gray-600">Edit</a>
                                            <a href="delete?id=<?php echo $row['id']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                            <a href="https://wa.me/<?php echo $row['nomor_telepon']; ?>" target="_blank" class="text-green-600 hover:text-green-900">Chat on WA</a>
                                        </td>
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
                    <p class="text-red-500 text-center py-4">Belum ada pendaftaran member.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
