@extends('layouts.master')

@section('title')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="" type="image/x-icon">
    <title>Explorer</title>
@endsection

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f6fb;
        margin: 0;
        padding: 0;
    }
    .dashboard {
        max-width: 1100px;
        margin: 30px auto;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        padding: 20px 30px;
    }
    h2 {
        color: #1a1a1a;
        margin-bottom: 5px;
    }
    p.subtitle {
        color: #555;
        margin-bottom: 20px;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn {
        background-color: #5b5ff0;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
    }
    .stats {
        display: flex;
        gap: 15px;
        margin: 20px 0;
    }
    .card {
        flex: 1;
        background: #f9f9ff;
        border-radius: 10px;
        padding: 15px;
        text-align: center;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .card h3 {
        font-size: 32px;
        margin: 8px 0;
        color: #3a45f7;
    }
    .tabs {
        display: flex;
        border-bottom: 2px solid #e6e8ef;
        margin-bottom: 15px;
    }
    .nav-link {
        flex: 1;
        text-align: center;
        padding: 10px 0;
        text-decoration: none;
        color: #555;
        font-weight: 500;
        background-color: #f8f9fc;
        border-radius: 8px 8px 0 0;
        margin-right: 5px;
        transition: all 0.3s ease;
    }
    .nav-link:hover {
        background-color: #eef0ff;
        color: #3a45f7;
    }
    .nav-link.active {
        background-color: #fff;
        border-bottom: 3px solid #5b5ff0;
        color: #3a45f7;
        font-weight: 600;
        box-shadow: 0 -1px 5px rgba(0,0,0,0.05);
    }
    .tab-pane {
        display: none;
    }
    .tab-pane.active {
        display: block;
    }
    .section {
        background-color: #fdfdff;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    #map {
        height: 400px;
        border-radius: 10px;
    }
    .tags {
        margin-top: 10px;
    }
    .tag {
        display: inline-block;
        background-color: #e8eaff;
        color: #333;
        padding: 6px 12px;
        border-radius: 20px;
        margin-right: 6px;
        font-size: 14px;
        cursor: pointer;
    }
</style>
@endsection

@section('contentHeader')
@endsection

@section('content')
<div class="dashboard">
    <div class="header">
        <div>
            <h2>Explorer Dashboard</h2>
            <p class="subtitle">Discover, explore, and earn rewards!</p>
        </div>
        <button class="btn">Scan QR</button>
    </div>

    <div class="stats">
        <div class="card">
            <p>LKB Balance</p>
            <h3>450</h3>
        </div>
        <div class="card">
            <p>Quests Completed</p>
            <h3>3</h3>
        </div>
        <div class="card">
            <p>NFTs Owned</p>
            <h3>2</h3>
        </div>
    </div>

    <!-- Tabs -->
    <div class="tabs">
        <a href="#tab_1" class="nav-link active">Quest Map</a>
        <a href="#tab_2" class="nav-link">Available Quests</a>
        <a href="#tab_3" class="nav-link">My NFTs</a>
    </div>

    <!-- Tab Content -->
    <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
            <div class="section">
                <h4>📍 Points of Interest</h4>
                <div id="map"></div>
                <div class="tags">
                    <span class="tag">Sunset Beach</span>
                    <span class="tag">Heritage Walk</span>
                    <span class="tag">Local Market</span>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab_2">
            <div class="section">
                <h4>🧭 Available Quests</h4>
                <p>List of quests will appear here.</p>
            </div>
        </div>
        <div class="tab-pane" id="tab_3">
            <div class="section">
                <h4>🎨 My NFTs</h4>
                <p>Your collected NFTs will appear here.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
let map;
let poiMarkers = [];

function initMap() {
    if (!map) {
        map = L.map('map').setView([15.2889971, 120.0247358], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Define POIs: tourist spots / merchants
  const poi = [
    { name: "Botolan Town Proper", lat: 15.2889971, lon: 120.0247358, type: "Landmark" },
    { name: "Botolan Public Market", lat: 15.28952, lon: 120.02741, type: "Merchant" },
    { name: "Agora Public Market", lat: 15.28887, lon: 120.02646, type: "Merchant" },
    { name: "Jossete’s Bakery", lat: 15.28829, lon: 120.02704, type: "Merchant" },
    { name: "Botolan Municipal Hall", lat: 15.28880, lon: 120.02340, type: "Landmark" },
    { name: "San Juan Barangay", lat: 15.2877, lon: 120.0675, type: "Barangay" },
    { name: "Bancal Barangay", lat: 15.3079, lon: 120.0023, type: "Barangay" },
    { name: "INDEX Farm & Resort", lat:15.307296546523704, lon: 120.01576557750876, type: "Merchant" },
    { name: "Peny Paradise Resort",lat:15.308083009583665, lon: 120.0225462017982, type:"Mechant"},
    { name: "Divine Fields Resort",lat:15.312206083135319, lon: 120.00450865991796, type:"Mechant"},
    { name: "Bancal Eco Park",lat:15.308230373080491, lon: 119.99937306822835, type:"Mechant"},
    { name: "Mangrove View",lat:15.30276527164757, lon: 119.99323330830852, type:"Mechant"},
    { name: "Panayunan Beach Resort",lat:15.300467904970887, lon: 119.98917780828621, type:"Mechant"},
    { name: "Kalinto Resort",lat:15.298874221423414, lon: 119.9898859114557, type:"Mechant"},
    { name: "Villa Elisa Resort",lat:15.297611684290471, lon: 119.99166689821524, type:"Mechant"},
    { name: "Dambana Euchastic Hermitage",lat:15.29685013939636, lon:119.99530383716356, type:"Mechant"},
    { name: "SambaLikha Art Cafe",lat:15.295022566085466, lon: 119.99624767802285, type:"Mechant"},
    { name: "Sambali Beach Farm",lat:15.294427068645915, lon: 119.99542030528593, type:"Mechant"},
    { name: "La Residencia Nanale",lat:15.293624305233934, lon: 119.99459853970806, type:"Mechant"},
    { name: "Ohana Beach Resort",lat:15.290326781934542, lon: 119.99747152435869, type:"Mechant"},
{ name: "Sunset Oceanview",lat:15.29013780530741, lon: 119.99777106255767, type:"Mechant"},
{ name: "Sunrise Paradise Resort",lat:15.289427702619875, lon: 119.99738308444164, type:"Mechant"},
{ name: "GOOD GUYS BEACH RESORT",lat:28918893600461, lon: 119.9975680481528, type:"Mechant"},
{ name: "Sundowners Beach Villas",lat:15.288943228496313, lon: 119.99841521791876, type:"Mechant"},
{ name: "Sundowners Beach Club",lat:15.288569486363444, lon:119.99780636091062, type:"Mechant"},
{ name: "B'izza Woodfire pizza&co.",lat:15.29009749527949, lon: 119.99901331726456, type:"Mechant"},
{ name: "Chuby Yumyums",lat:15.290232185130487, lon: 119.99989049552669, type:"Mechant"},
{ name: "Aliex Resto Bar",lat:15.289982246308204, lon: 119.99933319426856, type:"Mechant"},
{ name: "Pantamnan Resort",lat:15.293624305233934, lon: 119.999423068488, type:"Mechant"},
{ name: "Danacbunga Public Beach",lat:15.287451928619564, lon:119.9984417000356, type:"Mechant"},
{ name: "Poggio Bustone Renewal Center",lat:15.282230693119928, lon: 120.00339842228674, type:"Mechant"},
{ name: "Hayati Beach Resort",lat:15.280555735642539, lon: 120.00410446380194, type:"Mechant"},
{ name: "Kubo Kabana Beach Resort",lat:15.279957920389727, lon: 120.00442971583354, type:"Mechant"},
{ name: "Sandy Toes Beach Camp",lat:15.279394414406275, lon: 120.00520732518572, type:"Mechant"},
{ name: "Ohana Beach Camp",lat:15.278424741466853, lon: 120.00567389081087, type:"Mechant"},
{ name: "Indira Beach House",lat:15.277553286616445, lon: 120.00633202293487, type:"Mechant"},
{ name: "Alon Beach House",lat:15.2746825102431, lon: 120.00834397856521, type:"Mechant"},
{ name: "PLAYA HONDA BAR AND GRILL",lat:15.304066158083858, lon:119.99553171555422, type:"Mechant"},
{ name: "Limbo's Cafe",lat:15.308341467478838, lon: 120.00203779490367, type:"Mechant"},
{ name: "Shou Resort",lat:15.314109541348577, lon: 120.03257757865656, type:"Mechant"},
{ name: "Ina. Poon Bato Parish Church",lat:15.314592726265417, lon: 120.06463480056668, type:"Mechant"},
{ name: "Iglesia Filipina Independiente - Church and Shrine of Apo Apang",lat:15.315240837089089, lon: 120.06636658720969, type:"Mechant"},
{ name: "Mardex resort",lat:15.313419611986554, lon:120.06716052106542, type:"Mechant"},
{ name: "Shou Resort",lat:15.314109541348577, lon: 120.03257757865656, type:"Mechant"},
{ name: "7-Eleven",lat:15.288585861496573, lon: 120.02379620399718, type:"Mechant"},
{ name: "Spice Up",lat:15.291327397631008, lon: 120.02397414189122, type:"Mechant"},
{ name: "Botolan Peoples Plaza",lat:15.289020172592046, lon: 120.02424922788994, type:"Mechant"},
{ name: "Balin Pamana- Botolan Heritage Center",lat:15.289109400119534, lon: 120.02393504224321, type:"Mechant"},
{ name: "Sta. Monica Parish Catholic Basilica Botolan",lat:15.288897321952097, lon: 120.02502822891603, type:"Mechant"},
{ name: "Awte Grill and Resto",lat:15.288477473561334, lon: 120.02448190081682, type:"Mechant"},
{ name: "Bigbrew Coffee . Tea . Snacks",lat:15.288491236068037, lon: 120.02469262937953, type:"Mechant"},
{ name: "7 Eleven",lat:15.288767788128512, lon: 120.02738319359923, type:"Mechant"},

{ name: "Cindy’s Bakeshop",lat:15.288964421565364, lon: 120.02769902370888, type:"Mechant"},
{ name: "Ciel Rose Cafe", lat:15.288925580187358, lon:120.0283625929177, type:"Mechant"},
{ name: "Icylicious",lat:15.288884592144202, lon: 120.02881295593188, type:"Mechant"},
{ name: "Tito Tea",lat:15.289031420339043, lon: 120.02858429761638, type:"Mechant"},
{ name: "Likatu",lat:15.280124775483833, lon: 120.07828969994044, type:"Mechant"},
{ name: "Camp Kainomayan",lat:15.280229391504863, lon: 120.07948902789839, type:"Mechant"},
{ name: "Pinatubo Adventure Base Camp",lat:15.27949707827424, lon:120.07982713631698, type:"Mechant"},
{ name: "Bibig Impiyerno",lat:15.316793884080305, lon:120.15102433791549, type:"Mechant"},
{ name: "Tukal Tukal",lat:15.33116634909592, lon:120.15806719992551, type:"Mechant"},
{ name: "Mount Calib-ungan",lat:15.248658292994255, lon:120.0409062433601, type:"Mechant"},
{ name: "Villa Loreta Beach Resort",lat:15.242323625045106, lon:120.0131702405673, type:"Mechant"},
{ name: "C&J Sunset View Resort",lat:15.24107989482159, lon:120.01399959602917, type:"Mechant"},
{ name: "Rama International Beach Resort",lat:15.23367448727256, lon:120.01179966471739, type:"Mechant"},

  
  ];

        poi.forEach(p => {
            const marker = L.marker([p.lat, p.lon])
                .addTo(map)
                .bindPopup(`<strong>${p.name}</strong><br>Type: ${p.type}`);
            poiMarkers.push(marker);
        });
    } else {
        setTimeout(() => map.invalidateSize(), 100);
    }
}

// Initialize the map initially
initMap();

// Tab switching logic
document.querySelectorAll('.nav-link').forEach(tab => {
    tab.addEventListener('click', function(e) {
        e.preventDefault();

        // Remove active from all
        document.querySelectorAll('.nav-link').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));

        // Activate selected
        this.classList.add('active');
        const target = this.getAttribute('href');
        document.querySelector(target).classList.add('active');

        // Re-render map if switching to map tab
        if (target === '#tab_1') {
            initMap();
        }
    });
});
</script>
@endsection