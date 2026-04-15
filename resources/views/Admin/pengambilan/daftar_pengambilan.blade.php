@extends('Admin/Layouts.dashboard')

@section('title', 'Daftar Pengambilan')

@push('styles')
    @vite('resources/css/admin/pengambilan/daftar_pengambilan.css')
    @vite('resources/css/admin/sidebar/sidebar_tes.css')
@endpush

@section('content')
    <main class="main-content">
        <header class="navbar">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="header-left">
                <i id="sidebar-toggle" class="fas fa-bars"></i>
                <h1>Daftar Pengambilan</h1>
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
                    <h3>Konfirmasi Pengambilan Buku</h3>
                </div>
                <div class="card-body">
                    <div class="filter-controls">
                        <div class="search-wrapper">
                            <i class="fas fa-search"></i>
                            <input type="text" id="bookingSearch" placeholder="Cari Nama Penerima Atau Judul Buku...">
                        </div>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 12%;">ID Booking</th>
                                    <th style="width: 22%;">Buku</th>
                                    <th style="width: 22%;">Penerima</th>
                                    <th style="width: 14%;">Batas Ambil</th>
                                    <th style="width: 15%; text-align: center;">Status</th>
                                    <th style="width: 15%; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="bookingTableBody">
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
    @vite('resources/js/admin/pengambilan/pengambilan.js')
@endpush
