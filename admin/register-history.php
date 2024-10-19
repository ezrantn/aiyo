<?php
include "../db-config.php";

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
</head>
<body class="bg-gray-100 font-sans">
    <div id="dashboard" class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
        <div class="w-full md:w-64 bg-white shadow-lg p-6 h-full">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Admin Dashboard</h2>
            <ul class="space-y-2">
                <li>
                    <a href="#dashboard" class="text-gray-700 hover:bg-indigo-500 hover:text-white transition-colors duration-200 block p-3 rounded-lg">Dashboard</a>
                </li>
                <li>
                    <a href="./log-out.php" class="text-gray-700 hover:bg-indigo-500 hover:text-white transition-colors duration-200 block p-3 rounded-lg">Log Out</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-grow p-6 md:p-10">
            <h1 class="text-3xl font-extrabold mb-8 text-gray-800">Dashboard</h1>

            <!-- Navigation -->
            <nav class="bg-white shadow-md rounded-lg mb-8">
                <ul class="flex flex-wrap justify-center md:justify-end space-x-2 md:space-x-4 p-4">
                    <li>
                        <a href="./register-history.php" class="text-gray-700 hover:bg-indigo-500 hover:text-white transition-colors duration-200 px-4 py-2 rounded-full text-sm">List Pendaftaran Member</a>
                    </li>
                    <li>
                        <a href="./tuition-history.php" class="text-gray-700 hover:bg-indigo-500 hover:text-white transition-colors duration-200 px-4 py-2 rounded-full text-sm">List Pembayaran SPP Member</a>
                    </li>
                    <li>
                        <a href="./manage-matches.php" class="text-gray-700 hover:bg-indigo-500 hover:text-white transition-colors duration-200 px-4 py-2 rounded-full text-sm">Atur Jadwal Pertandingan</a>
                    </li>
                </ul>
            </nav>

            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <div class="px-6 py-4 bg-primary text-white">
                            <h2 class="text-xl font-bold">Pendaftaran Anggota Baru</h2>
                        </div>
                        <?php if ($result->num_rows > 0): ?>
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            <th class="px-6 py-4">ID</th>
                                            <th class="px-6 py-4">Nama</th>
                                            <th class="px-6 py-4">Email</th>
                                            <th class="px-6 py-4">Nomor Telepon</th>
                                            <th class="px-6 py-4">Asal Sekolah</th>
                                            <th class="px-6 py-4">Alasan</th>
                                            <th class="px-6 py-4">Tanggal Pendaftaran</th>
                                            <th class="px-6 py-4">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        <?php while($row = $result->fetch_assoc()): ?>
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['id']); ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo htmlspecialchars($row['nama']); ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['email']); ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['nomor_telepon']); ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['asal_sekolah']); ?></td>
                                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate"><?php echo htmlspecialchars($row['alasan']); ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo htmlspecialchars($row['created_at']); ?></td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="text-primary hover:text-secondary mr-3">Edit</a>
                                                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="text-red-600 hover:text-red-800 mr-3" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                                                    <a href="https://wa.me/<?php echo $row['nomor_telepon']; ?>" target="_blank" class="text-green-600 hover:text-green-800">Chat on WA</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="px-6 py-4 bg-gray-100 border-t border-gray-200">
                                <div class="flex justify-between items-center">
                                    <a
                                        href="?page=<?php echo max(1, $page - 1); ?>"
                                        class="px-4 py-2 bg-primary text-white rounded hover:bg-secondary transition-colors duration-200 <?php if ($page == 1) echo 'opacity-50 cursor-not-allowed'; ?>">
                                        Previous
                                    </a>
                                    <span class="text-gray-600">
                                        Page <?php echo $page; ?> of <?php echo $total_pages; ?>
                                    </span>
                                    <a
                                        href="?page=<?php echo min($total_pages, $page + 1); ?>"
                                        class="px-4 py-2 bg-primary text-white rounded hover:bg-secondary transition-colors duration-200 <?php if ($page == $total_pages) echo 'opacity-50 cursor-not-allowed'; ?>">
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
