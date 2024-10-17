<?php
session_start();

if (!isset($_SESSION['popup_seen'])) {
    $_SESSION['popup_seen'] = true; // Set the session variable to indicate the popup has been seen
    $showPopup = true; // Flag to show the popup
} else {
    $showPopup = false; // Don't show the popup
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/goldenphoenix/assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/goldenphoenix/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/goldenphoenix/assets/favicon-16x16.png">
    <link rel="manifest" href="/goldenphoenix/manifest.json">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #popup {
            display: none; /* Initially hidden */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000; /* Ensure it appears above other content */
            width: 90%; /* Set the width to be responsive */
            max-width: 400px; /* Maximum width */
            border-radius: 8px; /* Rounded corners */
            overflow: hidden; /* Prevent overflow */
        }

        #overlay {
            display: none; /* Initially hidden */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999; /* Ensure it appears above other content */
        }

        /* Close button style */
        #closePopup {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: #FF0000; /* Red color for visibility */
        }

        @media (max-width: 768px) {
        #navbar-default {
            transition: max-height 0.3s ease-out;
            max-height: 0;
            overflow: hidden;
        }
        #navbar-default.block {
            max-height: 500px; /* Adjust this value based on your menu height */
        }
    }
    </style>
</head>
<body class="font-sans flex flex-col min-h-screen" style="background-color: #F4F6FF;">

    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <div class="flex items-center space-x-3">
                <img src="assets/logo.png" class="h-8" alt="Golden Phoenix Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Golden Phoenix</span>
            </div>

            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>

            <div class="hidden w-full md:block md:w-auto ml-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="./index" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page" <?= $current_page == 'index.php' ? 'text-white bg-blue-700' : 'text-gray-900 hover:bg-gray-100' ?>>Home</a>
                    </li>
                    <li>
                        <a href="./online-ticket" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" <?= $current_page == 'online-ticket.php' ? 'text-white bg-blue-700' : 'text-gray-900 hover:bg-gray-100' ?>>Pembelian Tiket</a>
                    </li>
                    <li>
                        <a href="./register-member" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" <?= $current_page == 'register-member.php' ? 'text-white bg-blue-700' : 'text-gray-900 hover:bg-gray-100' ?>>Pendaftaran Anggota Baru</a>
                    </li>
                    <li>
                        <a href="./paid-tuition" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" <?= $current_page == 'paid-tuition.php' ? 'text-white bg-blue-700' : 'text-gray-900 hover:bg-gray-100' ?>>Pembayaran SPP</a>
                    </li>
                    <li>
                        <a href="./about-us" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" <?= $current_page == 'about-us' ? 'text-white bg-blue-700' : 'text-gray-900 hover:bg-gray-100' ?>>Tentang Kami</a>
                    </li>
                    <li>
                        <a href="./gallery" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" <?= $current_page == 'gallery.php' ? 'text-white bg-blue-700' : 'text-gray-900 hover:bg-gray-100' ?>>Gallery</a>
                    </li>
                    <li>
                        <a href="./merch" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" <?= $current_page == 'merch.php' ? 'text-white bg-blue-700' : 'text-gray-900 hover:bg-gray-100' ?>>Merchandise</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8 p-4">
        <!-- Hero Section -->
        <section class="bg-blue-600 text-white rounded-lg shadow-lg p-8 mb-12">
            <h1 class="text-4xl font-bold mb-4">Selamat Datang di Golden Phoenix Basketball!</h1>
            <p class="text-xl mb-6">Bergabunglah dengan klub basket paling bergengsi di Semarang dan rasakan adrenalin dalam setiap permainan!</p>
            <a href="./online-ticket" class="bg-white text-blue-600 font-bold py-2 px-4 rounded hover:bg-blue-100 transition duration-200">Pesan Tiketmu Sekarang!</a>
        </section>

        <!-- Upcoming Matches Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-semibold mb-4">Pertandingan Yang Akan Datang</h2>
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-2">Golden Phoenix vs SMA Loyola</h3>
                    <p class="text-gray-600 mb-4">5 Oktober 2024</p>
                    <a href="./online-ticket" class="text-blue-600 hover:text-blue-800 font-bold">Pesan Tiket</a>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-2">Golden Phoenix vs SMA Sedes Sapientiae</h3>
                    <p class="text-gray-600 mb-4">12 Oktober 2024</p>
                    <a href="./online-ticket" class="text-blue-600 hover:text-blue-800 font-bold">Pesan Tiket</a>
                </div>
            </div>
        </section>

        <!-- Quick Links Section -->
        <section class="mb-12 bg-gray-100">
            <h2 class="text-3xl font-semibold mb-4">Quick Links</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="flex flex-col">
                    <a href="./register-member" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-200 flex-1">
                        <h3 class="text-xl font-semibold mb-2">Jadilah Anggota Kami</h3>
                        <p class="text-gray-600">Bergabunglah dengan komunitas basket kami hari ini!</p>
                    </a>
                </div>
                <div class="flex flex-col">
                    <a href="./paid-tuition" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-200 flex-1">
                        <h3 class="text-xl font-semibold mb-2">Pembayaran SPP</h3>
                        <p class="text-gray-600">Kelola pembayaran Anda dengan mudah.</p>
                    </a>
                </div>
                <div class="flex flex-col"> <!-- Added margin-bottom for spacing -->
                    <a href="./gallery" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-200 flex-1">
                        <h3 class="text-xl font-semibold mb-2">Gallery</h3>
                        <p class="text-gray-600">Tertarik melihat kegiatan yang ada di Golden Phoenix?</p>
                    </a>
                </div>
            </div>

            <!-- Adding space before Merchandise -->
            <div class="mt-8"> <!-- Added margin-top for separation -->
                <h2 class="text-3xl font-semibold mb-4">Merchandise</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="flex flex-col">
                        <a href="./merch" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition duration-200 flex-1">
                            <h3 class="text-xl font-semibold mb-2">Merchandise</h3>
                            <p class="text-gray-600">Souvenir unik dan cantik untuk mendukung tim tercinta.</p>
                        </a>
                    </div>
                    <!-- Add more merchandise cards as needed -->
                </div>
            </div>
        </section>

    </main>

    <footer class="bg-gray-800 text-white p-4 mt-auto">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
            <p>&copy; 2024 Golden Phoenix Basketball. All rights reserved.</p>
            <div class="flex items-center space-x-4 mt-4 md:mt-0">
                <a href="https://aiyo.id/"><img src="./assets/aiyo.png" alt="Aiyo Logo" class="h-8"></a>
                <a href="https://siega.id"><img src="./assets/siega.png" alt="Siega Logo" class="h-8"></a>
            </div>
        </div>
    </footer>

    <?php if ($showPopup): ?>
    <div id="overlay"></div>
    <div id="popup">
        <img src="/goldenphoenix/assets/poster-gp.jpg" alt="Poster Golden Phoenix">
        <button id="closePopup" class="bg-red-500 text-white py-2 px-4 rounded">X</button>
    </div>
    <script>
        document.getElementById('overlay').style.display = 'block';
        document.getElementById('popup').style.display = 'block';

        document.getElementById('closePopup').onclick = function() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('popup').style.display = 'none';
        };
    </script>
    <?php endif; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.querySelector('[data-collapse-toggle="navbar-default"]');
            const navMenu = document.getElementById('navbar-default');

            hamburger.addEventListener('click', function() {
                navMenu.classList.toggle('hidden');
                navMenu.classList.toggle('block');
            });
        });
    </script>
</body>
</html>
