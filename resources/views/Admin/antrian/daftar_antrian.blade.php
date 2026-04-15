@extends('Admin/Layouts.dashboard')

@section('title', 'Daftar Antrian')

@push('styles')
    @vite('resources/css/admin/antrian/halaman_antrian.css')
    @vite('resources/css/admin/sidebar/sidebar_tes.css')
@endpush

@section('content')
    <main class="main-content">
        <header class="navbar">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="header-left">
                <i id="sidebar-toggle" class="fas fa-bars"></i>
                <h1>Daftar Antrian</h1>
            </div>

            <!-- User Profile -->
            <div class="header-right">
                <i class="fas fa-bell notification-bell"></i>
                <div class="user-profile">
                    <i class="fas fa-user-circle"></i>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3>Semua Daftar Antrian</h3>
                </div>

                <!-- Filter Controls -->
                <div class="card-body">
                    <div class="filter-controls">
                        <div class="search-wrapper">
                            <i class="fas fa-search"></i>
                            <input type="text" id="antrianSearch" placeholder="Cari Nama Pemesan Atau Judul...">
                        </div>
                    </div>

                    <!-- Struktur tabel -->
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 10%; text-align: center;">No Antrian</th>
                                    <th style="width: 15%;">kode buku</th>
                                    <th style="width: 22%; text-align: center;">Informasi Buku</th>
                                    <th style="width: 22%;">Pemesan</th>
                                    <th style="width: 16%;">Estimasi Ready</th>
                                    <th style="width: 15%; text-align: center;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="antrianTableBody">
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
    @vite('resources/js/admin/antrian/antrian.js')
@endpush