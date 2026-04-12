@extends('Admin/Layouts.dashboard')

@section('title', 'Dashboard Statistik - SIPERPUS')

@push('styles')
    @vite('resources/css/admin/statistik_laporan/statistik_laporan.css')
    @vite('resources/css/admin/sidebar/sidebar_tes.css')
@endpush

@section('content')
    <main class="main-content">
        <header class="navbar">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="header-left">
                <i id="sidebar-toggle" class="fas fa-bars"></i>
                <h1>Statistik Perpustakaan</h1>
            </div>
            <div class="header-right">
                <i class="fas fa-bell notification-bell"></i>
                <div class="user-profile">
                    <i class="fas fa-user-circle"></i>
                </div>
            </div>
        </header>

        <div class="stats-overview">
            <div class="stat-card card-blue">
                <span class="label">Rata-rata Peminjaman</span>
                <span class="value">4 Buku</span>
                <span class="sub-text">Per anggota tiap bulan</span>
            </div>
            <div class="stat-card card-green">
                <span class="label">Pertumbuhan Koleksi</span>
                <span class="value">+15%</span>
                <span class="sub-text">30 hari terakhir</span>
            </div>
            <div class="stat-card card-red">
                <span class="label">Tingkat Keterlambatan</span>
                <span class="value">8.4%</span>
                <span class="sub-text">Perlu perhatian lebih</span>
            </div>
        </div>

        <div class="main-grid">
            <div class="left-column">
                <div class="chart-card">
                    <h3>Tren Aktivitas Peminjaman</h3>
                    <div style="height: 300px;">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>

                <div class="chart-card">
                    <h3>Anggota Teraktif (Bulan Ini)</h3>
                    <div class="list-item">
                        <div class="rank-number">1.</div>
                        <div class="list-info">
                            <div class="list-title">Ahmad Fauzi</div>
                            <div class="list-subtitle">(XII RPL 1)</div>
                        </div>
                        <div class="list-count">12 Pinjam</div>
                    </div>
                    <div class="list-item">
                        <div class="rank-number">2.</div>
                        <div class="list-info">
                            <div class="list-title">Siti Aminah</div>
                            <div class="list-subtitle">(XI TKJ 2)</div>
                        </div>
                        <div class="list-count">10 Pinjam</div>
                    </div>
                    <div class="list-item">
                        <div class="rank-number">3.</div>
                        <div class="list-info">
                            <div class="list-title">Budi Santoso</div>
                            <div class="list-subtitle">(X MM 1)</div>
                        </div>
                        <div class="list-count">8 Pinjam</div>
                    </div>
                    <div class="list-item">
                        <div class="rank-number">4.</div>
                        <div class="list-info">
                            <div class="list-title">Dewi Lestari</div>
                            <div class="list-subtitle">(XII Akuntansi 3)</div>
                        </div>
                        <div class="list-count">7 Pinjam</div>
                    </div>
                </div>
            </div>

            <div class="right-column">
                <div class="chart-card">
                    <h3>Distribusi Genre Buku</h3>
                    <div style="max-width: 220px; margin: 0 auto 15px auto;">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>

                <div class="chart-card">
                    <h3>Top 5 Buku Terlaris</h3>
                    <div class="list-item">
                        <div class="rank-number">#1</div>
                        <div class="list-info">
                            <div class="list-title">Laskar Pelangi</div>
                        </div>
                        <div class="list-count">45x</div>
                    </div>
                    <div class="list-item">
                        <div class="rank-number">#2</div>
                        <div class="list-info">
                            <div class="list-title">Bumi (Tere Liye)</div>
                        </div>
                        <div class="list-count">38x</div>
                    </div>
                    <div class="list-item">
                        <div class="rank-number">#3</div>
                        <div class="list-info">
                            <div class="list-title">Filosofi Teras</div>
                        </div>
                        <div class="list-count">30x</div>
                    </div>
                    <div class="list-item">
                        <div class="rank-number">#4</div>
                        <div class="list-info">
                            <div class="list-title">Atomic Habits</div>
                        </div>
                        <div class="list-count">27x</div>
                    </div>
                    <div class="list-item">
                        <div class="rank-number">#5</div>
                        <div class="list-info">
                            <div class="list-title">Negeri 5 Menara</div>
                        </div>
                        <div class="list-count">22x</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>
@endsection
@push('scripts')
    @vite('resources/js/admin/statistik_laporan/statistik_laporan.js')
@endpush