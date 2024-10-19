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
                $query = "INSERT INTO matches (match_name, match_date) VALUES ('$match_name', '$match_date')";
                $conn->query($query);
                break;
            case 'edit':
                $id = intval($_POST['id']);
                $match_name = $conn->real_escape_string($_POST['match_name']);
                $match_date = $conn->real_escape_string($_POST['match_date']);
                $query = "UPDATE matches SET match_name = '$match_name', match_date = '$match_date' WHERE id = $id";
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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Manage Matches</h1>

        <!-- Add new match form -->
        <form action="" method="POST" class="mb-8 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-xl font-semibold mb-4">Add New Match</h2>
            <input type="hidden" name="action" value="add">
            <div class="mb-4">
                <label for="match_name" class="block text-gray-700 text-sm font-bold mb-2">Match Name:</label>
                <input type="text" id="match_name" name="match_name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="match_date" class="block text-gray-700 text-sm font-bold mb-2">Match Date:</label>
                <input type="date" id="match_date" name="match_date" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Match</button>
        </form>

        <!-- List of existing matches -->
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-xl font-semibold mb-4">Existing Matches</h2>
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Match Name</th>
                        <th class="px-4 py-2">Match Date</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matches as $match): ?>
                        <tr>
                            <td class="border px-4 py-2"><?= htmlspecialchars($match['match_name']) ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($match['match_date']) ?></td>
                            <td class="border px-4 py-2">
                                <form action="" method="POST" class="inline">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $match['id'] ?>">
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
                                </form>
                                <button onclick="editMatch(<?= $match['id'] ?>, '<?= htmlspecialchars($match['match_name']) ?>', '<?= $match['match_date'] ?>')" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="editModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="editForm" action="" method="POST" class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-4">
                        <label for="edit_match_name" class="block text-gray-700 text-sm font-bold mb-2">Match Name:</label>
                        <input type="text" id="edit_match_name" name="match_name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="edit_match_date" class="block text-gray-700 text-sm font-bold mb-2">Match Date:</label>
                        <input type="date" id="edit_match_date" name="match_date" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Update
                        </button>
                        <button type="button" onclick="closeEditModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
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
