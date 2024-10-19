<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandise</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/goldenphoenix/assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/goldenphoenix/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/goldenphoenix/assets/favicon-16x16.png">
    <link rel="manifest" href="/goldenphoenix/manifest.json">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        body {
            background-color: #F4F6FF;
        }

        .gallery-img {
            transition: transform 0.3s ease;
        }

        .gallery-img:hover {
            transform: scale(1.05); /* Zoom in on hover */
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
        .swiper-button-next, .swiper-button-prev {
            color: #ffffff;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 30px 20px;
            border-radius: 5px;
        }
        .swiper-pagination-bullet-active {
            background-color: #ffffff;
        }
    </style>
</head>
<body class="font-sans flex flex-col min-h-screen">

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
                        <a href="./index" class="block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="./online-ticket" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Pembelian Tiket</a>
                    </li>
                    <li>
                        <a href="./register-member" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Pendaftaran Anggota Baru</a>
                    </li>
                    <li>
                        <a href="./paid-tuition" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Pembayaran SPP</a>
                    </li>
                    <li>
                        <a href="./about-us" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Tentang Kami</a>
                    </li>
                    <li>
                        <a href="./gallery" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Gallery</a>
                    </li>
                    <li>
                        <a href="./merch" class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Merchandise</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8 p-4">
        <section class="bg-white rounded-lg shadow-lg p-8 mb-12">
            <h1 class="text-4xl font-bold mb-4">Merchandise</h1>
            <p class="text-xl mb-6 text-gray-600">Temukan merchandise resmi kami dan tunjukkan dukunganmu!</p>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Merchandise Card with Swiper -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl p-6">
                    <div class="relative w-full h-[500px] rounded-lg overflow-hidden">
                        <div class="swiper-container w-full h-full">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="./assets/merch/depan design 1.svg" alt="Kaos Tim - Depan" class="w-full h-full object-cover">
                                </div>
                                <div class="swiper-slide">
                                    <img src="./assets/merch/belakang design 2.svg" alt="Kaos Tim - Belakang" class="w-full h-full object-cover">
                                </div>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <h2 class="text-2xl font-semibold mt-6 text-gray-800">Golden Phoenix</h2>
                    <p class="text-gray-600 mt-2">Kaos nyaman dengan desain eksklusif untuk tampil gaya sambil mendukung tim Golden Phoenix.</p>
                    <button class="w-full mt-6 bg-blue-600 text-white py-3 rounded hover:bg-blue-700">
                        <a href="https://wa.me/628889728839?text=Saya%20tertarik%20membeli%20kaos%20Golden%20Phoenix">Pesan Sekarang</a>
                    </button>
                </div>

                <!-- Merchandise Card with Swiper -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl p-6">
                    <div class="relative w-full h-[500px] rounded-lg overflow-hidden">
                        <div class="swiper-container w-full h-full">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="./assets/merch/depan design 2.svg" alt="Kaos Tim - Depan" class="w-full h-full object-cover">
                                </div>
                                <div class="swiper-slide">
                                    <img src="./assets/merch/belakang design 1.svg" alt="Kaos Tim - Belakang" class="w-full h-full object-cover">
                                </div>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                    <h2 class="text-2xl font-semibold mt-6 text-gray-800">Shadow Phantom</h2>
                    <p class="text-gray-600 mt-2">Desain modern dan material berkualitas yang membuatmu tetap nyaman sepanjang hari.</p>
                    <button class="w-full mt-6 bg-blue-600 text-white py-3 rounded hover:bg-blue-700">
                        <a href="https://wa.me/628889728839?text=Saya%20tertarik%20membeli%20kaos%20Shadow%20Phantom">Pesan Sekarang</a>
                    </button>
                </div>

                <!-- Merchandise Card without Swiper -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl p-6">
                    <div class="relative w-full h-[500px] rounded-lg overflow-hidden">
                        <img src="./assets/merch/keychain.svg" alt="Kaos Tim 3" class="w-full h-full">
                    </div>
                    <h2 class="text-2xl font-semibold mt-6 text-gray-800">Gantungan Kunci</h2>
                    <p class="text-gray-600 mt-2">Bawa semangat tim ke mana saja dengan gantungan kunci stylish ini!</p>
                    <button class="w-full mt-6 bg-blue-600 text-white py-3 rounded hover:bg-blue-700">
                        <a href="https://wa.me/628889728839?text=Saya%20tertarik%20membeli%20gantungan%20kunci">Pesan Sekarang</a>
                    </button>
                </div>

                <!-- Merchandise Card without Swiper -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl p-6">
                    <div class="relative w-full h-[500px] rounded-lg overflow-hidden">
                        <img src="./assets/merch/sticker.svg" alt="Kaos Tim 4" class="w-full h-full">
                    </div>
                    <h2 class="text-2xl font-semibold mt-6 text-gray-800">Sticker</h2>
                    <p class="text-gray-600 mt-2">Percantik barang-barangmu dengan stiker keren bertema tim favorit.</p>
                    <button class="w-full mt-6 bg-blue-600 text-white py-3 rounded hover:bg-blue-700">
                        <a href="https://wa.me/628889728839?text=Saya%20tertarik%20membeli%20sticker">Pesan Sekarang</a>
                    </button>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white p-4 mt-auto">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
            <p>&copy; 2024 Golden Phoenix Basketball. All rights reserved.</p>
            <div class="flex items-center space-x-4 mt-4 md:mt-0">
                <a href="https://aiyo.id/"><img src="./assets/aiyo.png" alt="Aiyo Logo" class="h-8"></a>
                <a href="https://siega.id"><img src="./assets/siega.png" alt="Siega Logo" class="h-8"></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
         const swiper = new Swiper('.swiper-container', {
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        });
        
        document.addEventListener("DOMContentLoaded", function () {
            const hamburger = document.querySelector(
                '[data-collapse-toggle="navbar-default"]',
            );
            const navMenu = document.getElementById("navbar-default");

            hamburger.addEventListener("click", function () {
                navMenu.classList.toggle("hidden");
                navMenu.classList.toggle("block");
            });
            });
    </script>
</body>
</html>
