@extends('Admin/Layouts.dashboard')

@section('title', 'Daftar Anggota')

@push('styles')
    @vite('resources/css/admin/anggota/halaman_anggota_tanpa_sidebar.css')
    @vite('resources/css/admin/sidebar/sidebar_tes.css')
@endpush

@section('content')
        <main class="main-content">
            <header class="navbar">
                <div class="header-left">
                    <i id="sidebar-toggle" class="fas fa-bars"></i>
                    <h1>Daftar Anggota</h1>
                </div>
                <div class="header-right">
                    <i class="fas fa-bell"></i>
                    <div class="user-profile">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </header>
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <http://127.0.0.1:8000/api/books/>
                        <h3>Semua Anggota</h3>
                        <a href="#" class="btn btn-primary">Tambah Anggota</a>
                    </div>
                    <div class="filter-controls">
                        <button id="openFilterModal" class="filter-button">
                            <i class="fas fa-filter"></i>
                            <span>Filter</span>
                        </button>
                        <input type="text" id="memberSearch" placeholder="Cari Nama...">
                    </div>
                    <div class="card-body">
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="memberTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    <div id="modalOverlay" class="modal-overlay">
        <div id="filterModal" class="filter-modal">
            <div class="filter-modal-header">
                <h3>Filter Anggota</h3>
                <span id="closeFilterModal" class="filter-modal-close"><i class="fas fa-times"></i></span>
            </div>
            <div class="filter-modal-body">
                <div class="filter-group">
                    <label>Tipe Anggota:</label>
                    <div class="filter-options" id="typeFilterOptions">
                        <span class="filter-option-item selected" data-filter-value="">Semua Anggota</span>
                        <span class="filter-option-item" data-filter-value="Siswa">Siswa</span>
                        <span class="filter-option-item" data-filter-value="Admin">Admin</span>
                    </div>
                </div>
                <div class="filter-group" id="tingkatFilterGroup">
                    <label>Kelas:</label>
                    <div class="filter-options" id="tingkatFilterOptions">
                        <span class="filter-option-item selected" data-filter-value="">Semua Kelas</span>
                        <span class="filter-option-item" data-filter-value="X">X</span>
                        <span class="filter-option-item" data-filter-value="XI">XI</span>
                        <span class="filter-option-item" data-filter-value="XII">XII</span>
                    </div>
                </div>
                <div class="filter-group" id="jurusanFilterGroup">
                    <label>Kategori Jurusan:</label>
                    <div class="filter-options" id="jurusanFilterOptions">
                        <span class="filter-option-item selected" data-filter-value="">Semua Jurusan</span>
                        <span class="filter-option-item" data-filter-value="RPL">RPL</span>
                        <span class="filter-option-item" data-filter-value="TKJ">TKJ</span>
                        <span class="filter-option-item" data-filter-value="TEI">TEI</span>
                        <span class="filter-option-item" data-filter-value="Animasi">Animasi</span>
                        <span class="filter-option-item" data-filter-value="TSM">TSM</span>
                    </div>
                </div>
                <div class="filter-group" id="nomorKelasFilterGroup">
                    <label>Nomor Kelas:</label>
                    <div class="filter-options" id="nomorKelasFilterOptions">
                        <span class="filter-option-item selected" data-filter-value="">Semua Nomor</span>
                        <span class="filter-option-item" data-filter-value="1">1</span>
                        <span class="filter-option-item" data-filter-value="2">2</span>
                        <span class="filter-option-item" data-filter-value="3">3</span>
                    </div>
                </div>
            </div>
            <div class="filter-modal-actions">
                <button id="resetFiltersBtn" class="btn btn-secondary">Reset</button>
                <button id="applyFiltersBtn" class="btn btn-primary">Terapkan</button>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @vite('resources/js/admin/anggota/daftar_anggota.js')
@endpush
