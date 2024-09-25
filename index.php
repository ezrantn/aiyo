<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Phoenix Basketball</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <header class="bg-yellow-500 text-white p-4">
        <h1 class="text-3xl font-bold">Golden Phoenix Basketball</h1>
    </header>

    <nav class="bg-gray-800 text-white p-4">
        <ul class="flex space-x-4">
            <li><a href="#ticketing" class="text-white hover:text-gray-200">Ticketing</a></li>
            <li><a href="#about" class="text-white hover:text-gray-200">About Us</a></li>
        </ul>
    </nav>

    <main class="container mx-auto mt-8 p-4">
        <section id="ticketing" class="mb-12">
            <h2 class="text-2xl font-semibold mb-4">E-Ticketing System</h2>
            
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold mb-4">Select Your Tickets</h3>
                
                <div class="mb-4">
                    <label for="game" class="block mb-2">Select Game:</label>
                    <select id="game" class="w-full p-2 border rounded">
                        <option value="game1">Golden Phoenix vs Silver Eagles - June 15, 2024</option>
                        <option value="game2">Golden Phoenix vs Bronze Bulls - June 22, 2024</option>
                        <option value="game3">Golden Phoenix vs Platinum Panthers - June 29, 2024</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="quantity" class="block mb-2">Number of Tickets:</label>
                    <input type="number" id="quantity" min="1" max="10" value="1" class="w-full p-2 border rounded">
                </div>

                <div class="mb-4">
                    <label for="section" class="block mb-2">Select Section:</label>
                    <select id="section" class="w-full p-2 border rounded">
                        <option value="general">General Admission - $20</option>
                        <option value="vip">VIP Seats - $50</option>
                        <option value="courtside">Courtside - $100</option>
                    </select>
                </div>

                <button id="purchase" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Purchase Tickets</button>
            </div>

            <div id="confirmation" class="mt-8 bg-green-100 border-green-500 border p-4 rounded hidden">
                <h3 class="text-xl font-semibold mb-2">Ticket Purchase Confirmation</h3>
                <p id="confirmationDetails"></p>
            </div>
        </section>

        <section id="about" class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-4">About Golden Phoenix Basketball</h2>
            
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 pr-4">
                    <p class="mb-4">
                        Founded in 2010, the Golden Phoenix has quickly risen to become one of the most exciting teams in professional basketball. Our name symbolizes our ability to rise above challenges and constantly reinvent ourselves.
                    </p>
                    <p class="mb-4">
                        Based in Phoenix, Arizona, we pride ourselves on our fast-paced, high-flying style of play that keeps fans on the edge of their seats. Our team colors of gold and deep purple represent the beautiful Arizona sunsets and our royal commitment to excellence.
                    </p>
                    <p>
                        The Golden Phoenix is more than just a basketball team - we're a family. Our commitment to the community is as strong as our will to win on the court. Through various outreach programs and youth clinics, we strive to make a positive impact both on and off the court.
                    </p>
                </div>
                <div class="md:w-1/2 mt-4 md:mt-0">
                    <h3 class="text-xl font-semibold mb-2">Team Achievements</h3>
                    <ul class="list-disc pl-5">
                        <li>3-time Conference Champions (2015, 2018, 2022)</li>
                        <li>League Champions (2018)</li>
                        <li>6 consecutive playoff appearances (2017-2022)</li>
                        <li>Consistently ranked in the top 5 for team offense</li>
                        <li>Community Service Award (2019, 2021)</li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white p-4 mt-8">
        <p>&copy; 2024 Golden Phoenix Basketball. All rights reserved.</p>
    </footer>

    <script>
        document.getElementById('purchase').addEventListener('click', function() {
            const game = document.getElementById('game').value;
            const quantity = document.getElementById('quantity').value;
            const section = document.getElementById('section').value;
            
            let price;
            switch(section) {
                case 'general':
                    price = 20;
                    break;
                case 'vip':
                    price = 50;
                    break;
                case 'courtside':
                    price = 100;
                    break;
            }

            const total = price * quantity;

            const confirmationDiv = document.getElementById('confirmation');
            const confirmationDetails = document.getElementById('confirmationDetails');
            confirmationDetails.innerHTML = `
                You have purchased ${quantity} ticket(s) for ${game} in the ${section} section.<br>
                Total: $${total}
            `;
            confirmationDiv.classList.remove('hidden');
        });
    </script>
</body>
</html>