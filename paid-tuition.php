<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran SPP</title>
    <link rel="apple-touch-icon" sizes="180x180" href="/goldenphoenix/assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/goldenphoenix/assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/goldenphoenix/assets/favicon-16x16.png">
    <link rel="manifest" href="/goldenphoenix/manifest.json">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 font-sans flex flex-col min-h-screen">

    <header class="bg-yellow-500 text-white p-4">
        <div class="flex items-center">
            <img src="assets/logo.png" alt="Golden Phoenix Logo" class="h-16 w-16 mr-4">
            <h1 class="text-4xl font-bold">Golden Phoenix Basketball</h1>
        </div>
    </header>

    <nav class="bg-gray-800 text-white p-4">
        <ul class="flex space-x-4">
            <li><a href="./index.php" class="hover:text-gray-200">Pembelian Tiket</a></li>
            <li><a href="./about-us.php" class="hover:text-gray-200">Tentang Kami</a></li>
            <li><a href="./register-member.php" class="hover:text-gray-200">Pendaftaran Anggota Baru</a></li>
            <li><a href="./paid-tuition.php" class="hover:text-gray-200">Pembayaran</a></li>
        </ul>
    </nav>

    <main class="container mx-auto mt-8 p-4 flex-grow">
        <section id="pembayaran" class="mb-12">
            <h2 class="text-3xl font-semibold mb-4">Pembayaran SPP</h2>
            <form id="paymentForm" class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6" action="./tuition-process.php" method="POST">
                <div class="mb-5">
                    <label for="memberID" class="block mb-2 text-sm font-medium text-gray-900">ID Anggota</label>
                    <input type="text" id="memberID" name="memberID" class="bg-white border border-gray-300 text-black text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Masukkan ID anggota" required />
                </div>

                <div class="mb-5" id="fee-select-container" style="display: none;">
                    <label for="fee_category" class="block mb-2 text-sm font-medium text-gray-900">Fee Kategori</label>
                    <select id="fee_category" name="fee_category" class="bg-gray-100 border border-gray-300 text-black text-sm rounded-lg block w-full p-2.5" readonly>

                    </select>
                </div>

                <button type="submit" id="paymentButton" class="w-full bg-blue-500 text-white font-semibold py-2 rounded hover:bg-blue-600 transition duration-200">Bayar</button>

                <div class="mt-4 text-center">
                    <a href="./forgot-id.php" class="text-sm text-blue-500 hover:underline">Forgot ID?</a>
                </div>
            </form>
        </section>
    </main>

    <footer class="bg-gray-800 text-white p-4 mt-auto">
        <p>&copy; 2024 Golden Phoenix Basketball. All rights reserved.</p>
    </footer>

</body>
</html>
<script>
    document.getElementById('paymentButton').addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Pastikan anggota ID Anda benar!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, saya yakin!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('paymentForm').submit();
            }
        });
    });

function updateSelectOptions(lokasi) {
    var selectElement = document.getElementById('fee_category');
    var selectContainer = document.getElementById('fee-select-container');

    // Show the select element
    selectContainer.style.display = 'block';

    // Clear existing options
    selectElement.innerHTML = '';

    // Add new options based on the selected location
    if (lokasi === 'dalam') {
        var option = document.createElement('option');
        option.value = 'internal';
        option.text = 'Dalam Sekolah (100k)';
        selectElement.appendChild(option);
    } else if (lokasi === 'luar') {
        var option = document.createElement('option');
        option.value = 'external';
        option.text = 'Luar Sekolah (150k)';
        selectElement.appendChild(option);
    }

    // Set the select element to be readonly (uneditable)
    selectElement.setAttribute('disabled', true);
}
</script>
