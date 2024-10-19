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
        <div class="w-full md:w-64 bg-white shadow-lg p-6 md:h-screen">
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

            <!-- Content Area -->
            <div class="bg-white shadow-lg rounded-lg p-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-800">Main Content Area</h2>
                <p class="text-gray-600">This is where the main content will go. You can add more components, tables, or charts here.</p>
            </div>
        </div>
    </div>
</body>
</html>
