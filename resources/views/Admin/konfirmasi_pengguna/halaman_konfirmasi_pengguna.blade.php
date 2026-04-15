@extends('Admin/Layouts.dashboard')

@section('title', 'Konfirmasi Pengguna - SIPERPUS')

@push('styles')
    @vite('resources/css/admin/konfirmasi_pengguna/konfirmasi_pengguna.css')
    @vite('resources/css/admin/sidebar/sidebar_tes.css')
@endpush

@section('content')
    <main class="main-content">
        <header class="navbar">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="header-left">
                <i id="sidebar-toggle" class="fas fa-bars"></i>
                <h1>Konfirmasi Pengguna</h1>
            </div>
            <div class="header-right">
                <i class="fas fa-bell notification-bell"></i>
                <div class="user-profile">
                    <i class="fas fa-user-circle"></i>
                </div>
            </div>
        </header>

        <section class="content">
            <div class="card-header">
                <h3>Semua Anggota</h3>
            </div>
            <div class="card-body">
                <div class="filter-controls">
                    <button class="filter-button"><i class="fas fa-filter"></i> Filter</button>
                    <div class="search-wrapper">
                        <input type="text" id="memberSearch" placeholder="Cari Nama Anggota...">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 7%;">NO</th>
                                <th style="width: 20%;">NAMA</th>
                                <th style="width: 23%;">EMAIL</th>
                                <th style="width: 15%;" class="text-center">KATEGORI</th>
                                <th style="width: 12%;">TGL DAFTAR</th>
                                <th style="width: 15%;" class="text-center">VALIDASI</th>
                                <th style="width: 8%;" class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="memberTableBody"></tbody>
                    </table>
                </div>
            </div>
        </section>
        </div>
        </section>
    </main>
@endsection
@push('scripts')
    @vite('resources/js/admin/konfirmasi_pengguna/konfirmasi_pengguna.js')
@endpush