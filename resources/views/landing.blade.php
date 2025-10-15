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
                name: "Botolan Town Proper",
                lat: 15.2889971,
                lon: 120.0247358,
                type: "Landmark"
            },
            {
                name: "Botolan Public Market",
                lat: 15.28952,
                lon: 120.02741,
                type: "Merchant"
            },
            {
                name: "Agora Public Market",
                lat: 15.28887,
                lon: 120.02646,
                type: "Merchant"
            },
            {
                name: "Jossete’s Bakery",
                lat: 15.28829,
                lon: 120.02704,
                type: "Merchant"
            },
            {
                name: "Botolan Municipal Hall",
                lat: 15.28880,
                lon: 120.02340,
                type: "Landmark"
            },
            {
                name: "San Juan Barangay",
                lat: 15.2877,
                lon: 120.0675,
                type: "Barangay"
            },
            {
                name: "Bancal Barangay",
                lat: 15.3079,
                lon: 120.0023,
                type: "Barangay"
            },
            {
                name: "INDEX Farm & Resort",
                lat: 15.307296546523704,
                lon: 120.01576557750876,
                type: "Merchant"
            },
            {
                name: "Peny Paradise Resort",
                lat: 15.308083009583665,
                lon: 120.0225462017982,
                type: "Mechant"
            },
            {
                name: "Divine Fields Resort",
                lat: 15.312206083135319,
                lon: 120.00450865991796,
                type: "Mechant"
            },
            {
                name: "Bancal Eco Park",
                lat: 15.308230373080491,
                lon: 119.99937306822835,
                type: "Mechant"
            },
            {
                name: "Mangrove View",
                lat: 15.30276527164757,
                lon: 119.99323330830852,
                type: "Mechant"
            },
            {
                name: "Panayunan Beach Resort",
                lat: 15.300467904970887,
                lon: 119.98917780828621,
                type: "Mechant"
            },
            {
                name: "Kalinto Resort",
                lat: 15.298874221423414,
                lon: 119.9898859114557,
                type: "Mechant"
            },
            {
                name: "Villa Elisa Resort",
                lat: 15.297611684290471,
                lon: 119.99166689821524,
                type: "Mechant"
            },
            {
                name: "Dambana Euchastic Hermitage",
                lat: 15.29685013939636,
                lon: 119.99530383716356,
                type: "Mechant"
            },
            {
                name: "SambaLikha Art Cafe",
                lat: 15.295022566085466,
                lon: 119.99624767802285,
                type: "Mechant"
            },
            {
                name: "Sambali Beach Farm",
                lat: 15.294427068645915,
                lon: 119.99542030528593,
                type: "Mechant"
            },
            {
                name: "La Residencia Nanale",
                lat: 15.293624305233934,
                lon: 119.99459853970806,
                type: "Mechant"
            },
            {
                name: "Ohana Beach Resort",
                lat: 15.290326781934542,
                lon: 119.99747152435869,
                type: "Mechant"
            },
            {
                name: "Sunset Oceanview",
                lat: 15.29013780530741,
                lon: 119.99777106255767,
                type: "Mechant"
            },
            {
                name: "Sunrise Paradise Resort",
                lat: 15.289427702619875,
                lon: 119.99738308444164,
                type: "Mechant"
            },
            {
                name: "GOOD GUYS BEACH RESORT",
                lat: 28918893600461,
                lon: 119.9975680481528,
                type: "Mechant"
            },
            {
                name: "Sundowners Beach Villas",
                lat: 15.288943228496313,
                lon: 119.99841521791876,
                type: "Mechant"
            },
            {
                name: "Sundowners Beach Club",
                lat: 15.288569486363444,
                lon: 119.99780636091062,
                type: "Mechant"
            },
            {
                name: "B'izza Woodfire pizza&co.",
                lat: 15.29009749527949,
                lon: 119.99901331726456,
                type: "Mechant"
            },
            {
                name: "Chuby Yumyums",
                lat: 15.290232185130487,
                lon: 119.99989049552669,
                type: "Mechant"
            },
            {
                name: "Aliex Resto Bar",
                lat: 15.289982246308204,
                lon: 119.99933319426856,
                type: "Mechant"
            },
            {
                name: "Pantamnan Resort",
                lat: 15.293624305233934,
                lon: 119.999423068488,
                type: "Mechant"
            },
            {
                name: "Danacbunga Public Beach",
                lat: 15.287451928619564,
                lon: 119.9984417000356,
                type: "Mechant"
            },
            {
                name: "Poggio Bustone Renewal Center",
                lat: 15.282230693119928,
                lon: 120.00339842228674,
                type: "Mechant"
            },
            {
                name: "Hayati Beach Resort",
                lat: 15.280555735642539,
                lon: 120.00410446380194,
                type: "Mechant"
            },
            {
                name: "Kubo Kabana Beach Resort",
                lat: 15.279957920389727,
                lon: 120.00442971583354,
                type: "Mechant"
            },
            {
                name: "Sandy Toes Beach Camp",
                lat: 15.279394414406275,
                lon: 120.00520732518572,
                type: "Mechant"
            },
            {
                name: "Ohana Beach Camp",
                lat: 15.278424741466853,
                lon: 120.00567389081087,
                type: "Mechant"
            },
            {
                name: "Indira Beach House",
                lat: 15.277553286616445,
                lon: 120.00633202293487,
                type: "Mechant"
            },
            {
                name: "Alon Beach House",
                lat: 15.2746825102431,
                lon: 120.00834397856521,
                type: "Mechant"
            },
            {
                name: "PLAYA HONDA BAR AND GRILL",
                lat: 15.304066158083858,
                lon: 119.99553171555422,
                type: "Mechant"
            },
            {
                name: "Limbo's Cafe",
                lat: 15.308341467478838,
                lon: 120.00203779490367,
                type: "Mechant"
            },
            {
                name: "Shou Resort",
                lat: 15.314109541348577,
                lon: 120.03257757865656,
                type: "Mechant"
            },
            {
                name: "Ina. Poon Bato Parish Church",
                lat: 15.314592726265417,
                lon: 120.06463480056668,
                type: "Mechant"
            },
            {
                name: "Iglesia Filipina Independiente - Church and Shrine of Apo Apang",
                lat: 15.315240837089089,
                lon: 120.06636658720969,
                type: "Mechant"
            },
            {
                name: "Mardex resort",
                lat: 15.313419611986554,
                lon: 120.06716052106542,
                type: "Mechant"
            },
            {
                name: "Shou Resort",
                lat: 15.314109541348577,
                lon: 120.03257757865656,
                type: "Mechant"
            },
            {
                name: "7-Eleven",
                lat: 15.288585861496573,
                lon: 120.02379620399718,
                type: "Mechant"
            },
            {
                name: "Spice Up",
                lat: 15.291327397631008,
                lon: 120.02397414189122,
                type: "Mechant"
            },
            {
                name: "Botolan Peoples Plaza",
                lat: 15.289020172592046,
                lon: 120.02424922788994,
                type: "Mechant"
            },
            {
                name: "Balin Pamana- Botolan Heritage Center",
                lat: 15.289109400119534,
                lon: 120.02393504224321,
                type: "Mechant"
            },
            {
                name: "Sta. Monica Parish Catholic Basilica Botolan",
                lat: 15.288897321952097,
                lon: 120.02502822891603,
                type: "Mechant"
            },
            {
                name: "Awte Grill and Resto",
                lat: 15.288477473561334,
                lon: 120.02448190081682,
                type: "Mechant"
            },
            {
                name: "Bigbrew Coffee . Tea . Snacks",
                lat: 15.288491236068037,
                lon: 120.02469262937953,
                type: "Mechant"
            },
            {
                name: "7 Eleven",
                lat: 15.288767788128512,
                lon: 120.02738319359923,
                type: "Mechant"
            },

            {
                name: "Cindy’s Bakeshop",
                lat: 15.288964421565364,
                lon: 120.02769902370888,
                type: "Mechant"
            },
            {
                name: "Ciel Rose Cafe",
                lat: 15.288925580187358,
                lon: 120.0283625929177,
                type: "Mechant"
            },
            {
                name: "Icylicious",
                lat: 15.288884592144202,
                lon: 120.02881295593188,
                type: "Mechant"
            },
            {
                name: "Tito Tea",
                lat: 15.289031420339043,
                lon: 120.02858429761638,
                type: "Mechant"
            },
            {
                name: "Likatu",
                lat: 15.280124775483833,
                lon: 120.07828969994044,
                type: "Mechant"
            },
            {
                name: "Camp Kainomayan",
                lat: 15.280229391504863,
                lon: 120.07948902789839,
                type: "Mechant"
            },
            {
                name: "Pinatubo Adventure Base Camp",
                lat: 15.27949707827424,
                lon: 120.07982713631698,
                type: "Mechant"
            },
            {
                name: "Bibig Impiyerno",
                lat: 15.316793884080305,
                lon: 120.15102433791549,
                type: "Mechant"
            },
            {
                name: "Tukal Tukal",
                lat: 15.33116634909592,
                lon: 120.15806719992551,
                type: "Mechant"
            },
            {
                name: "Mount Calib-ungan",
                lat: 15.248658292994255,
                lon: 120.0409062433601,
                type: "Mechant"
            },
            {
                name: "Villa Loreta Beach Resort",
                lat: 15.242323625045106,
                lon: 120.0131702405673,
                type: "Mechant"
            },
            {
                name: "C&J Sunset View Resort",
                lat: 15.24107989482159,
                lon: 120.01399959602917,
                type: "Mechant"
            },
            {
                name: "Rama International Beach Resort",
                lat: 15.23367448727256,
                lon: 120.01179966471739,
                type: "Mechant"
            },


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
