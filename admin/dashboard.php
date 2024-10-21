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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            max-width: 100%;
            height: auto;
            margin: 0 auto;
        }
        @media (min-width: 768px) {
            .chart-container {
                max-width: 500px; /* Increase size on larger screens */
            }
        }
        #paymentChart {
            width: 100%;
            height: 100%; /* Let the chart take full space of container */
        }
    </style>
</head>
<body class="bg-gray-200 font-sans">
    <div id="dashboard" class="flex flex-col md:flex-row min-h-screen">
        <div class="w-full md:w-64 bg-gray-800 shadow-xl p-6 h-full text-white">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">Admin Dashboard</h2>
                <img src="/goldenphoenix/assets/logo.png" alt="Logo" class="w-10 h-10 rounded-full">
            </div>

            <ul class="space-y-4">
                <li>
                    <a href="./dashboard" class="flex items-center space-x-3 p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M3 9.75v7.5c0 1.379 1.12 2.5 2.5 2.5h13c1.38 0 2.5-1.121 2.5-2.5v-7.5"></path><path d="M21 9.75v-3.5a2.5 2.5 0 00-2.5-2.5h-13A2.5 2.5 0 003 6.25v3.5"></path></svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="./register-history" class="flex items-center space-x-3 p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 8v4m0 4h.01"></path><path d="M21 16.05A9.9 9.9 0 0012.15 3H12a9.9 9.9 0 00-9.9 9.9v.1a9.9 9.9 0 009.9 9.9h.15A9.9 9.9 0 0021 16.05z"></path></svg>
                        <span>List Pendaftaran Member</span>
                    </a>
                </li>
                <li>
                    <a href="./tuition-history" class="flex items-center space-x-3 p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 8v4m0 4h.01"></path><path d="M21 16.05A9.9 9.9 0 0012.15 3H12a9.9 9.9 0 00-9.9 9.9v.1a9.9 9.9 0 009.9 9.9h.15A9.9 9.9 0 0021 16.05z"></path></svg>
                        <span>List Pembayaran SPP Member</span>
                    </a>
                </li>
                <li>
                    <a href="./manage-matches" class="flex items-center space-x-3 p-3 bg-gray-700 rounded-lg hover:bg-gray-600 transition duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 8v4m0 4h.01"></path><path d="M21 16.05A9.9 9.9 0 0012.15 3H12a9.9 9.9 0 00-9.9 9.9v.1a9.9 9.9 0 009.9 9.9h.15A9.9 9.9 0 0021 16.05z"></path></svg>
                        <span>Atur Jadwal Pertandingan</span>
                    </a>
                </li>
                <li>
                    <a href="./log-out" class="flex items-center space-x-3 p-3 bg-red-500 rounded-lg hover:bg-red-600 transition duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17 16l4-4m0 0l-4-4m4 4H7"></path><path d="M12 19H5a2 2 0 01-2-2V7a2 2 0 012-2h7"></path></svg>
                        <span>Log Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="flex-grow p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Payments by Method</h2>
            <div class="bg-white shadow-lg rounded-lg p-6">
                <div class="chart-container">
                    <canvas id="paymentChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        fetch('./tuition-history?chart_data=1')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.payment_method);
                const counts = data.map(item => item.count);

                const ctx = document.getElementById('paymentChart').getContext('2d');
                const paymentChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Payments by Method',
                            data: counts,
                            backgroundColor: [
                                'rgba(0, 0, 0, 0.2)',
                                'rgba(0, 0, 0, 0.3)',
                                'rgba(0, 0, 0, 0.4)',
                                'rgba(0, 0, 0, 0.5)',
                                'rgba(0, 0, 0, 0.6)'
                            ],
                            borderColor: [
                                'rgba(0, 0, 0, 1)',
                                'rgba(0, 0, 0, 1)',
                                'rgba(0, 0, 0, 1)',
                                'rgba(0, 0, 0, 1)',
                                'rgba(0, 0, 0, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false, // Disable aspect ratio to better control size
                    }
                });
            })
            .catch(error => console.error('Error fetching chart data:', error));
    </script>
</body>
</html>
