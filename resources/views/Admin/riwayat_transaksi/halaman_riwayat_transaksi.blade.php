@extends('Admin/Layouts.dashboard')

@section('title', 'Halaman Riwayat Transaksi - SIPERPUS')

@push('styles')
    @vite('resources/css/admin/riwayat_transaksi/riwayat_transaksi.css')
    @vite('resources/css/admin/sidebar/sidebar_tes.css')
@endpush

@section('content')
    <main class="main-content">
        <header class="navbar">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="header-left">
                <i id="sidebar-toggle" class="fas fa-bars"></i>
                <h1>Riwayat Transaksi</h1>
            </div>
            <div class="header-right">
                <i class="fas fa-bell notification-bell"></i>
                <div class="user-profile">
                    <i class="fas fa-user-circle"></i>
                </div>
            </div>
        </header>

        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3>Semua Riwayat Transaksi</h3>
                </div>
                
                <div class="card-body">
                    <div class="controls-row">
                        <div class="search-wrapper">
                            <i class="fas fa-search"></i>
                            <input type="text" id="riwayatSearch" placeholder="Cari Nama Anggota atau Judul Buku...">
                        </div>
                        <div class="filter-buttons">
                            <button class="btn-filter active">Semua Status</button>
                            <button class="btn-filter">Dipinjam</button>
                            <button class="btn-filter">Selesai</button>
                            <button class="btn-filter">Terlambat</button>
                        </div>
                    </div>

                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 12%;">Id Transaksi</th>
                                    <th style="width: 20%;">Nama Anggota</th>
                                    <th style="width: 20%;">Judul Buku</th>
                                    <th style="width: 14%;">Tgl Pinjam</th>
                                    <th style="width: 12%;">Tgl Kembali</th>
                                    <th style="width: 11%; text-align: center;">Status</th>
                                    <th style="width: 11%; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="riwayatTableBody">
                            </tbody>
                        </table>
                    </div>
                    <div id="pagination" class="pagination-container"></div>
                </div>
            </div>
        </section>
    </main>

@endsection
@push('scripts')
    @vite('resources/js/admin/riwayat_transaksi/riwayat_transaksi.js')
@endpush