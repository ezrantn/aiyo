<?php
include "./db-config.php";

$current_page = basename($_SERVER['PHP_SELF']);

$result = $conn->query("SELECT * FROM matches ORDER BY match_date");
$matches = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembelian Tiket</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/goldenphoenix/assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/goldenphoenix/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/goldenphoenix/assets/favicon-16x16.png">
    <link rel="manifest" href="/goldenphoenix/manifest.json">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<body class="font-sans" style="background-color: #F4F6FF;">

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

            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700 ml-auto">
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

    <main class="container mx-auto mt-8 p-4">
        <section id="ticketing" class="mb-12">
            <h2 class="text-4xl font-bold mb-4">Pembelian Tiket Pertandingan</h2>
            <form id="ticketForm" class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6" action="response.php" method="POST" enctype="multipart/form-data">
                <div class="mb-5">
                    <label for="userName" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" id="userName" name="userName" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan nama Anda" required />
                </div>

                <div class="mb-5">
                    <label for="userEmail" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" id="userEmail" name="userEmail" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan email Anda" required />
                </div>

                <label for="userPhone" class="block mb-2 text-sm font-medium text-gray-900">Nomor Telepon</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 top-0 flex items-center pl-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                            <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
                        </svg>
                    </div>
                    <input type="text" id="userPhone" name="userPhone" maxlength="15" aria-describedby="helper-text-explanation" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pl-10" placeholder="123-456-789-012" oninput="formatPhoneNumber(this)" required />
                </div>
                <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-black-400 mb-3">Pilih nomor telepon sesuai format yang tertera</p>

                <div class="mb-5">
                    <label for="remarks" class="block mb-2 text-sm font-medium text-gray-900">Catatan (Optional)</label>
                    <input type="text" id="remarks" name="remarks" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan catatan Anda" />
                </div>

                <section class="bg-gray-50 rounded-lg shadow-md p-6 mb-5">
                    <h3 class="text-xl font-semibold mb-4">Pilih Tiket Anda</h3>

                    <div class="mb-4">
                        <label for="ticket-type" class="block mb-2 text-sm font-medium text-gray-900">Jenis Tiket:</label>
                        <select id="ticket-type" name="ticketType"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5
                                       focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Jenis Tiket --</option>
                            <option value="Reguler">Reguler (Rp 10.000)</option>
                            <option value="Premium">Premium (Rp 15.000)</option>
                        </select>
                    </div>

                    <aside class="bg-yellow-100 text-yellow-800 p-4 rounded-lg mb-4">
                        <h4 class="font-semibold mb-2">Perbedaan Tiket Premium dan Reguler:</h4>
                        <p><strong>Reguler:</strong> Tiket Reguler memberikan tempat duduk di barisan belakang tribun, namun tetap memberikan pengalaman menonton yang nyaman.</p>
                        <p class="mb-2"><strong>Premium:</strong> Tiket Premium memberikan Anda tempat duduk di paling depan tribun, sehingga Anda bisa lebih dekat dengan lapangan.</p>
                    </aside>

                    <div class="mb-4">
                        <label for="match" class="block mb-2 text-sm font-medium text-gray-900">Pilih Pertandingan:</label>
                        <select id="match" name="match"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5
                                       focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Pertandingan --</option>
                            <option value="loyola">Golden Phoenix vs SMA Loyola, 5 Oktober 2024</option>
                            <option value="sedes">Golden Phoenix vs SMA Sedes Sapientiae, 12 Oktober 2024</option>
                            <?php foreach ($matches as $match): ?>
                                <option value="<?= $match['id'] ?>">
                                    <?= htmlspecialchars($match['match_name']) ?>, <?= date('d F Y', strtotime($match['match_date'])) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900">Pesan Berapa Tiket:</label>
                        <input type="number" id="quantity" name="quantity" min="1" max="10" value="1"
                            class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                </section>

                <button type="button" id="submitButton" class="w-full bg-blue-500 text-white font-semibold py-2 rounded hover:bg-blue-600 transition duration-200">
                    Pesan
                </button>
            </form>
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

    <script src="./scripts/script.js"></script>
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

<?php
$conn->close();
?>
