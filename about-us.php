<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/goldenphoenix/assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/goldenphoenix/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/goldenphoenix/assets/favicon-16x16.png">
    <link rel="manifest" href="/goldenphoenix/manifest.json">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
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
                        <a href="./about-us" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" <?= $current_page == 'about-us.php' ? 'text-white bg-blue-700' : 'text-gray-900 hover:bg-gray-100' ?>>Tentang Kami</a>
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

    <main class="flex-grow">
        <section id="about" class="bg-white rounded-lg shadow-lg p-10 mt-8 mx-auto max-w-full md:max-w-6xl">
            <h2 class="text-4xl font-bold mb-4">Tentang Kami</h2>
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 pr-8 mb-4 md:mb-0">
                    <p class="text-lg mb-4">Sekolah Nusaputera Semarang adalah lembaga pendidikan yang telah berdiri sejak tahun 2006, berkomitmen untuk memberikan pendidikan berkualitas.</p>
                    <p class="text-lg mb-4">Di Nusaputera, kami percaya bahwa setiap siswa memiliki potensi unik yang perlu dikembangkan.</p>
                    <p class="text-lg mb-4">Dengan pendekatan holistik, kami membimbing siswa untuk tidak hanya unggul secara akademik, tetapi juga menjadi individu yang berintegritas.</p>
                    <p class="text-lg mb-4">Didukung oleh tenaga pengajar yang profesional dan berpengalaman, kami menciptakan pengalaman belajar yang bermakna dan menyenangkan.</p>
                </div>

                <div class="md:w-1/2 pl-8">
                    <div class="mb-6">
                        <h3 class="text-2xl font-semibold mb-4">Lokasi</h3>
                        <div class="flex justify-center">
                            <iframe src="https://www.google.com/maps/embed?pb=..." width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                    <div class="mb-6">
                        <h3 class="text-2xl font-semibold mb-2">Hubungi Kami</h3>
                        <p class="text-lg">
                            <a href="mailto:goldenphoenixbasketball@gmail.com" class="text-blue-500 flex items-center">
                                <i class="fas fa-envelope mr-2"></i>
                                Email Us
                            </a>
                        </p>
                    </div>
                    <div>
                        <h3 class="text-2xl font-semibold mb-2">Follow Social Media</h3>
                        <div class="flex space-x-4">
                            <a href="https://www.instagram.com/goldenphoenixbasketball" class="text-blue-500 hover:text-blue-700">
                                <i class="fab fa-instagram fa-2x"></i>
                            </a>
                            <a href="https://www.tiktok.com/@goldenphoenixbasketball" class="text-blue-500 hover:text-blue-700">
                                <i class="fab fa-tiktok fa-2x"></i>
                            </a>
                        </div>
                    </div>
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
