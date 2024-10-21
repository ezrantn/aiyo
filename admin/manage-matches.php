<?php
session_start();
include "../db-config.php";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $match_name = $conn->real_escape_string($_POST['match_name']);
                $match_date = $conn->real_escape_string($_POST['match_date']);
                $match_location = $conn->real_escape_string($_POST['match_location']);
                $query = "INSERT INTO matches (match_name, match_date, match_location) VALUES ('$match_name', '$match_date', '$match_location')";
                $conn->query($query);
                break;
            case 'edit':
                $id = intval($_POST['id']);
                $match_name = $conn->real_escape_string($_POST['match_name']);
                $match_date = $conn->real_escape_string($_POST['match_date']);
                $match_location = $conn->real_escape_string($_POST['match_location']);
                $query = "UPDATE matches SET match_name = '$match_name', match_date = '$match_date', match_location = '$match_location' WHERE id = $id";
                $conn->query($query);
                break;
            case 'delete':
                $id = intval($_POST['id']);
                $query = "DELETE FROM matches WHERE id = $id";
                $conn->query($query);
                break;
        }
    }
}

$result = $conn->query("SELECT * FROM matches ORDER BY match_date");
$matches = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Matches | Admin Dashboard</title>
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
        <div class="flex-grow p-4 md:p-6 lg:p-8">
            <h1 class="text-2xl md:text-3xl font-extrabold mb-6 text-gray-800">Manage Matches</h1>

            <!-- Add New Match Form -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
                <div class="px-4 py-3 bg-gray-800 text-white">
                    <h2 class="text-lg font-semibold">Add New Match</h2>
                </div>
                <form action="" method="POST" class="px-4 py-6">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-4">
                        <label for="match_name" class="block text-sm font-medium text-gray-700">Match Name</label>
                        <input type="text" id="match_name" name="match_name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="match_location" class="block text-sm font-medium text-gray-700">Match Location</label>
                        <input type="text" id="match_date" name="match_location" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="match_date" class="block text-sm font-medium text-gray-700">Match Date</label>
                        <input type="date" id="match_date" name="match_date" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Match</button>
                </form>
            </div>

            <!-- Existing Matches List -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="px-4 py-3 bg-gray-800 text-white">
                    <h2 class="text-lg font-semibold">Existing Matches</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Match Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Match Location</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Match Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($matches as $match): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($match['match_name']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($match['match_location']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($match['match_date']) ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <!-- Edit Button -->
                                    <button onclick="editMatch(<?= $match['id'] ?>, '<?= htmlspecialchars($match['match_name']) ?>', '<?= $match['match_date'] ?>')" class="text-yellow-600 hover:text-yellow-900 mr-2">Edit</button>

                                    <!-- Delete Form -->
                                    <form action="" method="POST" class="inline">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= $match['id'] ?>">
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl">
                <form id="editForm" action="" method="POST" class="px-4 py-6">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-4">
                        <label for="edit_match_name" class="block text-sm font-medium text-gray-700">Match Name</label>
                        <input type="text" id="edit_match_name" name="match_name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                    </div>
                    <div class="mb-4">
                        <label for="edit_match_date" class="block text-sm font-medium text-gray-700">Match Date</label>
                        <input type="date" id="edit_match_date" name="match_date" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
                    </div>
                    <div class="flex justify-end space-x-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
                        <button type="button" onclick="closeEditModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editMatch(id, name, date) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_match_name').value = name;
            document.getElementById('edit_match_date').value = date;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
