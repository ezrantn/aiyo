<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Anggota Baru</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/goldenphoenix/assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/goldenphoenix/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/goldenphoenix/assets/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="manifest" href="/goldenphoenix/manifest.json">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        #overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1000;
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
        <section id="pendaftaran" class="mb-12">
            <h2 class="text-4xl font-bold mb-4">Pendaftaran Anggota Baru</h2>
            <form id="registerForm" class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6" action="./register-process.php" method="POST">
                <div class="mb-5">
                    <label for="Nama Siswa" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" id="memberName" name="Nama Siswa" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan nama Anda" required />
                </div>

                <div class="mb-5">
                    <label for="Email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" id="memberEmail" name="Email" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan email Anda" required />
                </div>

                <label for="Nomor Telepon" class="block mb-2 text-sm font-medium text-gray-900">Nomor Telepon</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 top-0 flex items-center pl-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                            <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z" />
                        </svg>
                    </div>
                    <input type="text" id="memberPhone" name="Nomor Telepon" maxlength="15" aria-describedby="helper-text-explanation" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pl-10" placeholder="123-456-789-012" oninput="formatPhoneNumberRegistration(this)" required />
                </div>
                <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-black-400 mb-3">Pilih nomor telepon sesuai format yang tertera</p>

                <div class="mb-5">
                    <label for="Asal Sekolah" class="block mb-2 text-sm font-medium text-gray-900">Asal Sekolah</label>
                    <input type="text" id="memberSekolah" name="Asal Sekolah" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan asal sekolah" onkeyup="checkNusaputera()" required />
                </div>

                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Lokasi Sekolah</label>
                    <div class="flex items-center mb-2">
                        <input id="dalam" type="radio" name="lokasi_sekolah" value="dalam" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                        <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900">Dalam Nusaputera</label>
                    </div>
                    <div class="flex items-center">
                        <input id="luar" type="radio" name="lokasi_sekolah" value="luar" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                        <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900">Luar Nusaputera</label>
                    </div>
                </div>

                <div class="mb-5">
                    <label for="Alasan Mendaftar" class="block mb-2 text-sm font-medium text-gray-900">Alasan Mendaftar (Optional)</label>
                    <textarea id="memberAlasan" name="Alasan Mendaftar" rows="4" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Tuliskan alasan mendaftar" required></textarea>
                </div>

                <button type="submit" id="registerButton" class="w-full bg-blue-500 text-white font-semibold py-2 rounded hover:bg-blue-600 transition duration-200">Daftar</button>
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

    <div id="overlay"></div>
    <script src="./scripts/register-script.js"></script>
</body>

</html>

<script>
    function formatPhoneNumberRegistration(input) {
    let value = input.value.replace(/\D/g, "");

    if (value.length > 3 && value.length <= 6) {
      value = value.slice(0, 3) + "-" + value.slice(3);
    } else if (value.length > 6 && value.length <= 9) {
      value = value.slice(0, 3) + "-" + value.slice(3, 6) + "-" + value.slice(6);
    } else if (value.length > 9) {
      value =
        value.slice(0, 3) +
        "-" +
        value.slice(3, 6) +
        "-" +
        value.slice(6, 9) +
        "-" +
        value.slice(9);
    }

    input.value = value;
  }

  document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.querySelector('[data-collapse-toggle="navbar-default"]');
    const navMenu = document.getElementById('navbar-default');

    hamburger.addEventListener('click', function() {
        navMenu.classList.toggle('hidden');
        navMenu.classList.toggle('block');
    });
});
</script>
