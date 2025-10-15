@extends('layouts.master')

@section('title')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="" type="image/x-icon">
    <title>LGU Admin</title>
@endsection

@section('css')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #fdf8f5;
        margin: 0;
        padding: 0;
        color: #333;
    }
    header {
        padding: 20px 40px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    header h1 {
        font-size: 22px;
        margin: 0;
        color: #1a1a1a;
    }
    header span {
        display: block;
        font-size: 13px;
        color: #888;
    }
    .btn {
        background-color: #f97316;
        color: #fff;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
    }
    .stats {
        display: flex;
        gap: 20px;
        padding: 30px 40px;
        flex-wrap: wrap;
    }
    .stat-card {
        flex: 1;
        min-width: 200px;
        background-color: #fff;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 1px 5px rgba(0,0,0,0.1);
    }
    .stat-card h3 {
        margin: 0;
        font-size: 28px;
        color: #2563eb;
    }
    .stat-card p {
        margin: 5px 0 0;
        color: #777;
        font-size: 14px;
    }
    .tabs {
        background: #fff;
        margin: 0 40px 30px;
        border-radius: 12px;
        box-shadow: 0 1px 5px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .tab-buttons {
        display: flex;
        border-bottom: 1px solid #ddd;
    }
    .tab-buttons button {
        flex: 1;
        padding: 12px;
        border: none;
        background: #f8f8f8;
        cursor: pointer;
        font-size: 15px;
        font-weight: 500;
        transition: 0.2s;
    }
    .tab-buttons button.active {
        background: #f97316;
        color: #fff;
    }
    .tab-content {
        display: none;
        padding: 20px;
        animation: fadeIn 0.3s ease-in-out;
    }
    .tab-content.active {
        display: block;
    }
    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }
    .dashboard-content {
        padding: 10px 0;
        display: grid;
        grid-template-columns: 2fr 1fr;
        grid-gap: 20px;
    }
    .panel {
        background-color: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 1px 5px rgba(0,0,0,0.1);
    }
    .panel h4 {
        margin-bottom: 15px;
        font-size: 16px;
        color: #222;
    }
    .chart {
        height: 200px;
        background-color: #fafafa;
        border: 1px dashed #ccc;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #aaa;
    }
    .top-locations { margin-top: 10px; }
    .location { margin-bottom: 12px; }
    .bar { height: 8px; border-radius: 5px; background-color: #f97316; }
    .bar-bg { background-color: #eee; border-radius: 5px; height: 8px; width: 100%; margin-top: 5px; }
    .completion {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    .circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: conic-gradient(#f97316 0% 68%, #eee 68% 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        font-size: 18px;
        color: #333;
    }
    .key-metrics {
        margin-top: 15px;
    }
    .key-metrics div {
        margin-bottom: 10px;
        display: flex;
        justify-content: space-between;
        font-size: 14px;
    }
    @media (max-width: 900px) {
        .dashboard-content {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('contentHeader')
@endsection

@section('content')
<header>
    <div>
        <h1>LGU Admin Dashboard</h1>
        <span>Tourism & Community Management</span>
    </div>
    <button class="btn">+ Create Reward Pool</button>
</header>

<section class="stats">
    <div class="stat-card">
        <h3>2847</h3>
        <p>Total Visitors</p>
    </div>
    <div class="stat-card">
        <h3 style="color:#16a34a;">5632</h3>
        <p>Check-ins</p>
    </div>
    <div class="stat-card">
        <h3 style="color:#2563eb;">1456</h3>
        <p>Active Users</p>
    </div>
    <div class="stat-card">
        <h3 style="color:#f97316;">847</h3>
        <p>NFTs Minted</p>
    </div>
</section>

<div class="tabs">
    <div class="tab-buttons">
        <button class="active" onclick="openTab(event, 'tab1')">Analytics</button>
        <button onclick="openTab(event, 'tab2')">Locations</button>
        <button onclick="openTab(event, 'tab3')">Reward Pools</button>
    </div>
    <div id="tab1" class="tab-content active">
        <section class="dashboard-content">
            <div class="panel">
                <h4>Token Distribution Trend</h4>
                <div class="chart">[Chart Placeholder]</div>
                <p style="margin-top:10px;font-size:13px;color:#666;">Total: 92,600 LKB distributed</p>
            </div>
            <div class="panel">
                <h4>Top Locations</h4>
                <div class="top-locations">
                    <div class="location">
                        <strong>1. Sunset Beach</strong> – 892 visits
                        <div class="bar-bg"><div class="bar" style="width:90%;"></div></div>
                    </div>
                    <div class="location">
                        <strong>2. Local Market</strong> – 734 visits
                        <div class="bar-bg"><div class="bar" style="width:75%;"></div></div>
                    </div>
                    <div class="location">
                        <strong>3. Heritage Walk</strong> – 623 visits
                        <div class="bar-bg"><div class="bar" style="width:60%;"></div></div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <h4>Quest Completion Rate</h4>
                <div class="completion">
                    <div class="circle">68.5%</div>
                    <p style="align-self:center;color:#555;">Complete</p>
                </div>
            </div>
            <div class="panel">
                <h4>Key Metrics</h4>
                <div class="key-metrics">
                    <div><span>Avg. Check-ins per User</span> <strong>3.9</strong></div>
                    <div><span>Avg. Quest Duration</span> <strong>2.5 hrs</strong></div>
                    <div><span>User Retention Rate</span> <strong>84%</strong></div>
                    <div><span>Tokens per Quest</span> <strong>145</strong></div>
                </div>
            </div>
        </section>
    </div>
    <div id="tab2" class="tab-content">
        <p>Location insights, heatmaps, and visitor tracking data go here.</p>
    </div>
    <div id="tab3" class="tab-content">
        <p>Reward pool creation, progress tracking, and NFT statistics appear here.</p>
    </div>
</div>
@endsection

@section('script')
<script>
    function openTab(evt, tabId) {
        const contents = document.querySelectorAll('.tab-content');
        const buttons = document.querySelectorAll('.tab-buttons button');
        contents.forEach(c => c.classList.remove('active'));
        buttons.forEach(b => b.classList.remove('active'));
        document.getElementById(tabId).classList.add('active');
        evt.currentTarget.classList.add('active');
    }
</script>
@endsection