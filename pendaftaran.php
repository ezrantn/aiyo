<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Anggota Baru</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/goldenphoenix/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/goldenphoenix/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="manifest" href="/goldenphoenix/manifest.json">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 font-sans">

    <header class="bg-yellow-500 text-white p-4">
        <div class="flex items-center">
            <img src="assets/logo.png" alt="Golden Phoenix Logo" class="h-16 w-16 mr-4">
            <h1 class="text-4xl font-bold">Golden Phoenix Basketball</h1>
        </div>
    </header>

    <nav class="bg-gray-800 text-white p-4">
        <ul class="flex space-x-4">
            <li><a href="./index.php" class="hover:text-gray-200">Pembelian Tiket</a></li>
            <li><a href="./about_us.php" class="hover:text-gray-200">Tentang Kami</a></li>
            <li><a href="#pendaftaran" class="hover:text-gray-200">Pendaftaran Anggota Baru</a></li>
            <li><a href="./pembayaran.php" class="hover:text-gray-200">Pembayaran</a></li>
        </ul>
    </nav>

    <main class="container mx-auto mt-8 p-4">
        <section id="pendaftaran" class="mb-12">
            <h2 class="text-3xl font-semibold mb-4">Pendaftaran Anggota Baru</h2>
            <form id="registerForm" class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6" action="submit_pendaftaran.php" method="POST">
                <div class="mb-5">
                    <label for="memberName" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" id="memberName" name="memberName" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan nama Anda" required />
                </div>

                <div class="mb-5">
                    <label for="memberEmail" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" id="memberEmail" name="memberEmail" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan email Anda" required />
                </div>

                <label for="memberPhone" class="block mb-2 text-sm font-medium text-gray-900">Nomor Telepon</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 top-0 flex items-center pl-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                            <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                            </svg>
                    </div>
                    <input type="text" id="memberPhone" name="memberPhone" maxlength="15" aria-describedby="helper-text-explanation" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pl-10" placeholder="123-456-789-012" oninput="formatPhoneNumber(this)" required />
                </div>
                <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-black-400 mb-3">Pilih nomor telepon sesuai format yang tertera</p>

                <div class="mb-5">
                    <label for="memberSekolah" class="block mb-2 text-sm font-medium text-gray-900">Asal Sekolah</label>
                    <input type="text" id="memberSekolah" name="memberSekolah" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan asal sekolah" required />
                </div>

                <div class="mb-5">
                    <label for="memberAlasan" class="block mb-2 text-sm font-medium text-gray-900">Alasan Mendaftar</label>
                    <textarea id="memberAlasan" name="memberAlasan" rows="4" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Tuliskan alasan mendaftar" required></textarea>
                </div>

                <button type="submit" id="registerButton" class="w-full bg-blue-500 text-white font-semibold py-2 rounded hover:bg-blue-600 transition duration-200">Daftar</button>
            </form>
        </section>
    </main>

    <footer class="bg-gray-800 text-white p-4 mt-8">
        <p>&copy; 2024 Golden Phoenix Basketball. All rights reserved.</p>
    </footer>

</body>
</html>
<script>
    document.getElementById('registerButton').addEventListener('click', function(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Setelah data dikirim, Anda tidak bisa mengubahnya lagi.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, saya mau mendaftar!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = {
                memberName: document.getElementById('memberName').value,
                memberEmail: document.getElementById('memberEmail').value,
                memberPhone: document.getElementById('memberPhone').value,
                memberSekolah: document.getElementById('memberSekolah').value,
                memberAlasan: document.getElementById('memberAlasan').value
            };
            fetch('submit_pendaftaran.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(formData).toString()
            })
            .then(response => {
                if (response.ok) {
                    return response.text();
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                const [message, userId] = data.split('|'); 

                Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'warning',
                title: 'PENDAFTARAN BERHASIL!',
                text: `PASTIKAN ANDA MENYIMPAN KODE INI! JANGAN SAMPAI HILANG!: ${userId}`,
                background: '#f8d7da',
                titleText: 'PENDAFTARAN BERHASIL!',
                html: `<strong style="font-size: 18px; color: #d32f2f;">SIMPAN KODE INI JANGAN SAMPAI LUPA!: <br>${userId}</strong>`,
                showConfirmButton: true,
                confirmButtonText: 'SAYA MENGERTI!',
                confirmButtonColor: '#721c24',
                timer: 10000
            });
            })
            .catch(error => {
                Swal.fire({
                    title: 'Gagal!',
                    text: error.message,
                    icon: 'error'
                });
            });
        }
    });
});


    function formatPhoneNumber(input) {
        let value = input.value.replace(/\D/g, '');

        if (value.length > 3 && value.length <= 6) {
            value = value.slice(0, 3) + '-' + value.slice(3);
        } else if (value.length > 6 && value.length <= 9) {
            value = value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6);
        } else if (value.length > 9) {
            value = value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6, 9) + '-' + value.slice(9);
        }

        input.value = value;
    }
</script>
