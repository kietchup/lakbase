@extends('layouts.master')

@section('title')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="" type="image/x-icon">
    <title>Merchant</title>
@endsection

@section('css')
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
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }
        @media (min-width: 640px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (min-width: 1024px) {
            .stats {
                grid-template-columns: repeat(4, 1fr);
            }
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
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 20px;
        }
        .tab {
            padding: 8px 16px;
            font-weight: 600;
            color: #2d3748;
            border: none;
            background: none;
            cursor: pointer;
            border-bottom: 4px solid transparent;
            transition: color 0.2s;
        }
        .tab.active {
            border-bottom: 4px solid #3b82f6;
            color: #2d3748;
        }
        .tab:not(.active) {
            color: #6b7280;
        }
        .tab:not(.active):hover {
            color: #2d3748;
        }
        .offer-card {
            background: #fff;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(59,130,246,0.08);
            border: 1px solid #f3f4f6;
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
            <button class="create-offer-btn">
                + Create Offer
            </button>
        </div>

        <!-- Stats Cards -->
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

        <div class="row">
            <div class="col-12">
                <!-- Custom Tabs -->
                <div class="card">
                    <div class="card-header p-0">
                        <div class="row w-100 m-0">
                            <div class="col-4 p-2">
                                <a class="nav-link active w-100 text-center" href="#tab_1" data-toggle="tab">My Offers</a>
                            </div>
                            <div class="col-4 p-2">
                                <a class="nav-link w-100 text-center" href="#tab_2" data-toggle="tab">Analytics</a>
                            </div>
                            <div class="col-4 p-2">
                                <a class="nav-link w-100 text-center" href="#tab_3" data-toggle="tab">Business Profile</a>
                            </div>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                A wonderful serenity has taken possession of my entire soul,
                                like these sweet mornings of spring which I enjoy with my whole heart.
                                I am alone, and feel the charm of existence in this spot,
                                which was created for the bliss of souls like mine. I am so happy,
                                my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                                that I neglect my talents. I should be incapable of drawing a single stroke
                                at the present moment; and yet I feel that I never was a greater artist than now.
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                The European languages are members of the same family. Their separate existence is a myth.
                                For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                                in their grammar, their pronunciation and their most common words. Everyone realizes why a
                                new common language would be desirable: one could refuse to pay expensive translators. To
                                achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                                words. If several languages coalesce, the grammar of the resulting language is more simple
                                and regular than that of the individual languages.
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                It has survived not only five centuries, but also the leap into electronic typesetting,
                                remaining essentially unchanged. It was popularised in the 1960s with the release of
                                Letraset
                                sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
                                like Aldus PageMaker including versions of Lorem Ipsum.
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- ./card -->
            </div>
            <!-- /.col -->
        </div>

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
@endsection

@section('script')
@endsection
