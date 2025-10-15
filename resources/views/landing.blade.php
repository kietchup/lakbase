<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LakBase | Gamified Tourism on Base</title>

    <!-- ✅ TailwindCSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Leaflet --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        .shadow-b {
            box-shadow: 0 2px 8px -2px rgba(0, 0, 0, 0.08);
        }

        /* Ensure modal always appears on top of everything */
        #signupModal {
            z-index: 9999;
            /* Higher than Leaflet map layers */
        }

        /* Ensure the map stays below modal */
        #mapContainer {
            z-index: 0;
            position: relative;
        }

        /* Optional: prevent map from "stealing" clicks when modal is active */
        #signupModal:not(.hidden)~#mapContainer {
            pointer-events: none;
            filter: blur(2px);
            /* Optional aesthetic blur when modal opens */
        }

        #signupModal {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        #signupModal:not(.hidden) {
            opacity: 1;
        }
    </style>
</head>

<body class="bg-gradient-to-b from-blue-50 to-white min-h-screen text-gray-800">

    <!-- Header -->
    <header class="fixed top-0 left-0 w-full shadow-b border-b border-gray-200 bg-white z-50">
        <div class="flex justify-between items-center px-6 py-4 max-w-6xl mx-auto">
            <div class="flex items-center gap-2">
                <div class="bg-indigo-600 p-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c0 .28-.22.5-.5.5S11 11.28 11 11s.22-.5.5-.5.5.22.5.5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 22s8-7.58 8-12a8 8 0 10-16 0c0 4.42 8 12 8 12z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-bold text-gray-900">LakBase</h1>
                    <p class="text-sm text-gray-500 -mt-1">Gamified Tourism on Base</p>
                </div>
            </div>

            <button
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 9V7a5 5 0 00-10 0v2M5 12h14m-3 8H8a2 2 0 01-2-2v-4h12v4a2 2 0 01-2 2z" />
                </svg>
                Connect Wallet
            </button>
        </div>
    </header>
    <!-- Add top padding to body content for header height -->
    <div class="pt-20"></div>

    <!-- Hero Section -->
    <section class="text-center px-6 py-16">
        <div class="inline-block bg-blue-100 text-blue-800 px-4 py-1 rounded-full text-sm font-medium mb-4">
            Built on Base Blockchain
        </div>

        <h2 class="text-5xl font-extrabold text-gray-900 mb-4">Explore. Earn. Collect.</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-10">
            The gamified local tourism platform where you complete quests at real places,
            earn tokens, and mint NFT souvenirs on Base.
        </p>

        <!-- Feature Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button
                class="border border-gray-200 rounded-full px-4 py-2 flex items-center gap-2 hover:bg-gray-100 transition">
                🏁 QR Check-ins
            </button>
            <button
                class="border border-gray-200 rounded-full px-4 py-2 flex items-center gap-2 hover:bg-gray-100 transition">
                💰 Token Rewards
            </button>
            <button
                class="border border-gray-200 rounded-full px-4 py-2 flex items-center gap-2 hover:bg-gray-100 transition">
                🎁 NFT Souvenirs
            </button>
            <button
                class="border border-gray-200 rounded-full px-4 py-2 flex items-center gap-2 hover:bg-gray-100 transition">
                📍 Real Places
            </button>
        </div>

        <div class="max-w-md mx-auto bg-yellow-50 border border-yellow-200 text-yellow-800 py-3 px-4 rounded-lg mb-16">
            <span class="font-medium">⚠ Connect your wallet first</span> to access LakBase features
        </div>
    </section>

    <!-- Map Section -->
    <section class="max-w-6xl mx-auto px-6 mb-20">
        <h3 class="text-2xl font-bold text-gray-900 text-center mb-8">Discover Botolan</h3>

        {{-- <!-- Map Container -->
        <div class="relative w-full h-[500px] bg-gray-200 rounded-2xl overflow-hidden shadow-lg cursor-pointer" id="mapContainer">

            <!-- Example Map Image (replace with your actual map or embed) -->
            <img src="https://upload.wikimedia.org/wikipedia/commons/7/7d/Zambales_Botolan.png" 
                 alt="Botolan Map" class="w-full h-full object-cover">

            <!-- Example Points of Interest -->
            <div class="absolute top-[40%] left-[45%] transform -translate-x-1/2 -translate-y-1/2">
                <img src="https://upload.wikimedia.org/wikipedia/commons/e/e3/Beach_icon.png" 
                     alt="Beach Logo" class="w-10 h-10 rounded-full border-2 border-white shadow-lg hover:scale-110 transition" />
            </div>

            <div class="absolute top-[60%] left-[60%] transform -translate-x-1/2 -translate-y-1/2">
                <img src="https://upload.wikimedia.org/wikipedia/commons/1/11/Mountain_icon.png" 
                     alt="Mountain Logo" class="w-10 h-10 rounded-full border-2 border-white shadow-lg hover:scale-110 transition" />
            </div>

            <div class="absolute top-[30%] left-[70%] transform -translate-x-1/2 -translate-y-1/2">
                <img src="https://upload.wikimedia.org/wikipedia/commons/8/8b/Museum_icon.png" 
                     alt="Museum Logo" class="w-10 h-10 rounded-full border-2 border-white shadow-lg hover:scale-110 transition" />
            </div>

        </div> --}}
        <div id="mapContainer" class="relative w-full h-[500px] bg-gray-200 rounded-2xl overflow-hidden shadow-lg">

        </div>
    </section>

    <!-- Modal (Hidden by Default) -->
    <div id="signupModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-8 relative">
            <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">&times;</button>
            <h4 class="text-2xl font-semibold mb-4 text-gray-900 text-center">Create Your Account</h4>
            <form action="{{-- {{ route('register') }} --}}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Full Name"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 outline-none"
                    required>
                <input type="email" name="email" placeholder="Email"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 outline-none"
                    required>
                <input type="password" name="password" placeholder="Password"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 outline-none"
                    required>
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 font-medium transition">
                    Sign Up
                </button>
                <p class="mb-0">
                    <a href="{{-- {{ route('getRegister') }} --}}" class="text-center text-dark"><u>I already have an account.</u></a>
                </p>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="w-full border-t border-gray-200 bg-white">
        <div class="max-w-6xl mx-auto py-6 px-6 text-center text-sm text-gray-500">
            © 2025 LakBase. Built on Base Blockchain.
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Initialize map centered in Botolan, Zambales
        const map = L.map('mapContainer').setView([15.2883, 120.0244], 13);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Tourist spots and merchants in Botolan
        const locations = [{
                name: "Sundowners Beach Villas",
                lat: 15.2683,
                lon: 120.0307,
                type: "Tourist Spot",
                icon: "{{asset('adminlte/assets/logos/Sundowners.jpg')}}"
            },
            {
                name: "Icylicious Botolan",
                lat: 15.2892,
                lon: 120.0269,
                type: "Merchant",
                icon: "{{ asset('adminlte/assets/logos/Icylicious.jpg') }}"

            },
            {
                name: "Botolan Public Market",
                lat: 15.2895,
                lon: 120.0274,
                type: "Merchant",
                icon: "{{ asset('adminlte/assets/logos/Botolan.jpg') }}"
            },
            {
                name: "Riverside Viewpoint",
                lat: 15.3001,
                lon: 120.0160,
                type: "Tourist Spot",
                icon: "https://upload.wikimedia.org/wikipedia/commons/1/11/Mountain_icon.png"
            }
        ];

        // Add custom markers with icons and popups
        locations.forEach(loc => {
            const customIcon = L.icon({
                iconUrl: loc.icon,
                iconSize: [38, 38],
                iconAnchor: [19, 38],
                popupAnchor: [0, -35]
            });

            L.marker([loc.lat, loc.lon], {
                    icon: customIcon
                })
                .addTo(map)
                .bindPopup(`<strong>${loc.name}</strong><br>Type: ${loc.type}`);
        });

        const mapContainer = document.getElementById('mapContainer');
        const signupModal = document.getElementById('signupModal');
        const closeModal = document.getElementById('closeModal');

        mapContainer.addEventListener('click', () => {
            signupModal.classList.remove('hidden');
        });

        closeModal.addEventListener('click', () => {
            signupModal.classList.add('hidden');
        });

        // Close modal on background click
        signupModal.addEventListener('click', (e) => {
            if (e.target === signupModal) {
                signupModal.classList.add('hidden');
            }
        });
    </script>

</body>

</html>
