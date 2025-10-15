@extends('layouts.master')

@section('title')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="" type="image/x-icon">
    <title>Merchant</title>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    body {
      background: #f9fafb;
      min-height: 100vh;
      margin: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
    }
    .container {
      padding: 24px;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
    }
    .header-title {
      font-size: 2rem;
      font-weight: bold;
      color: #2d3748;
      margin: 0;
    }
    .header-sub {
      color: #6b7280;
      margin: 0;
    }
    .create-offer-btn {
      background: linear-gradient(to right, #4ade80, #3b82f6);
      color: #fff;
      font-weight: 500;
      padding: 10px 20px;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(59,130,246,0.08);
      border: none;
      cursor: pointer;
      transition: opacity 0.2s;
    }
    .create-offer-btn:hover {
      opacity: 0.9;
    }
    .stats {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-bottom: 24px;
    }
    .card {
      background: #fff;
      border-radius: 18px;
      padding: 20px;
      box-shadow: 0 2px 8px rgba(59,130,246,0.08);
      border: 1px solid #f3f4f6;
    }
    .card-title {
      color: #6b7280;
      font-size: 0.95rem;
      margin-bottom: 8px;
    }
    .card-content {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-top: 8px;
    }
    .card-value {
      font-size: 2rem;
      font-weight: bold;
    }
    .card-icon {
      font-size: 1.5rem;
    }
    .blue { color: #2563eb; }
    .green { color: #22c55e; }
    .purple { color: #a21caf; }
    .orange { color: #f97316; }
    .tab-bar {
      display: flex;
      gap: 10px;
      background: #f1f5f9;
      padding: 8px;
      border-radius: 12px;
      margin-bottom: 20px;
    }
    .tab {
      flex: 1;
      background: transparent;
      border: none;
      padding: 10px 15px;
      border-radius: 10px;
      cursor: pointer;
      font-weight: 600;
      color: #555;
      transition: all 0.25s ease;
    }
    .tab:hover {
      background: #e0e7ff;
      color: #1e40af;
    }
    .tab.active {
      background: #ffffff;
      color: #1e3a8a;
      box-shadow: 0 2px 6px rgba(0,0,0,0.08);
      font-weight: 700;
    }
    .tab-pane {
      display: none;
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 6px rgba(59,130,246,0.08);
      border: 1px solid #f3f4f6;
    }
    .tab-pane.active {
      display: block;
    }
    .offer-card {
      background: #fff;
      border-radius: 18px;
      padding: 24px;
      box-shadow: 0 2px 8px rgba(59,130,246,0.08);
      border: 1px solid #f3f4f6;
      margin-top: 20px;
    }
    .offer-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 8px;
    }
    .offer-title {
      font-size: 1.1rem;
      font-weight: 600;
      color: #2d3748;
    }
    .offer-status {
      background: #000;
      color: #fff;
      font-size: 0.8rem;
      padding: 4px 12px;
      border-radius: 999px;
    }
    .offer-desc {
      color: #6b7280;
      font-size: 0.95rem;
      margin-bottom: 12px;
    }
    .offer-discount {
      background: #ecfdf5;
      border: 1px solid #bbf7d0;
      border-radius: 12px;
      padding: 16px;
      margin-bottom: 12px;
    }
    .offer-discount-value {
      font-size: 1.5rem;
      font-weight: bold;
      color: #22c55e;
    }
    .offer-footer {
      display: flex;
      justify-content: space-between;
      font-size: 0.95rem;
      color: #6b7280;
    }
</style>
@endsection

@section('contentHeader')
@endsection

@section('content')
<div class="container">
    <!-- Header -->
    <div class="header">
      <div>
        <h1 class="header-title">Merchant Dashboard</h1>
        <p class="header-sub">Local Market Co.</p>
      </div>
      <button class="create-offer-btn">+ Create Offer</button>
    </div>

    <!-- Stats -->
    <div class="stats">
      <div class="card">
        <div class="card-title">Total Visitors</div>
        <div class="card-content">
          <span class="card-value blue">892</span>
          <i class="fas fa-user card-icon blue"></i>
        </div>
      </div>
      <div class="card">
        <div class="card-title">App Sales</div>
        <div class="card-content">
          <span class="card-value green">₱12,450</span>
          <i class="fas fa-dollar-sign card-icon green"></i>
        </div>
      </div>
      <div class="card">
        <div class="card-title">Active Offers</div>
        <div class="card-content">
          <span class="card-value purple">1</span>
          <i class="fas fa-gift card-icon purple"></i>
        </div>
      </div>
      <div class="card">
        <div class="card-title">Checkpoints</div>
        <div class="card-content">
          <span class="card-value orange">1</span>
          <i class="fas fa-map-marker-alt card-icon orange"></i>
        </div>
      </div>
    </div>

    <!-- Tabs -->
    <div class="tab-bar">
      <button class="tab active" data-target="#tab1">My Offers</button>
      <button class="tab" data-target="#tab2">Analytics</button>
      <button class="tab" data-target="#tab3">Business Profile</button>
    </div>

    <div class="tab-content">
      <div class="tab-pane active" id="tab1">
        <!-- Offer Card -->
        <div class="offer-card">
          <div class="offer-header">
            <span class="offer-title">15% Off for NFT Holders</span>
            <span class="offer-status">Active</span>
          </div>
          <p class="offer-desc">Show any LakBase NFT and get instant discount</p>
          <div class="offer-discount">
            <span class="offer-discount-value">15% OFF</span>
          </div>
          <div class="offer-footer">
            <span>Redeemed: 45 times</span>
            <span>Valid until: 12/31/2025</span>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="tab2">
        <p>The European languages are members of the same family. Their separate existence is a myth.</p>
      </div>
      <div class="tab-pane" id="tab3">
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
      </div>
    </div>
</div>
@endsection

@section('script')
<script>
    const tabs = document.querySelectorAll('.tab');
    const panes = document.querySelectorAll('.tab-pane');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        panes.forEach(p => p.classList.remove('active'));

        tab.classList.add('active');
        const target = document.querySelector(tab.dataset.target);
        if (target) target.classList.add('active');
      });
    });
</script>
@endsection