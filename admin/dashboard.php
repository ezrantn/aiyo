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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div id="dashboard" class="flex">
        <div class="w-64 bg-white shadow-md p-4">
            <h2 class="text-lg font-semibold mb-4">Admin Dashboard</h2>
            <ul>
                <li class="mb-2">
                    <a href="#dashboard" class="text-gray-700 hover:bg-gray-200 block p-2 rounded">Dashboard</a>
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
                <h2 class="text-lg font-semibold mb-4">Main Content Area</h2>
                <p>This is where the main content will go.</p>
            </div>
        </div>
    </div>
</body>
</html>
