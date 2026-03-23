@extends('Admin/Layouts.dashboard')

@section('title', 'Halaman Buku')

@push('styles')
    <link rel="stylesheet" href="{{ asset('asset/css/admin/buku/halaman_buku.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/admin/sidebar/sidebar_tes.css') }}">
@endpush

@section('content')
    <main class="main-content">
        <header class="navbar">
            <div class="header-left">
                <i id="sidebar-toggle" class="fas fa-bars"></i>
                <h1>Daftar Buku</h1>
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
                    <h3>Semua Buku</h3>
                    <div style="display: flex; gap: 10px;">
                        <a href="#" class="btn btn-primary">Tambah Buku</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="filter-controls">
                        <button id="filterButton" class="filter-button"><i class="fas fa-filter"></i> Filter</button>
                        <input type="text" id="bookSearch" placeholder="Cari buku...">
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Cover</th>
                                    <th>Judul Buku</th>
                                    <th>Pengarang</th>
                                    <th>Penerbit</th>
                                    <th>Kategori</th>
                                    <th>Genre</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="bookTableBody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
        <div id="modalOverlay" class="modal-overlay">
            <div class="filter-modal">
                <div class="filter-modal-header">
                    <h3>Filter Buku</h3>
                    <span id="closeModal" class="filter-modal-close">&times;</span>
                </div>
                <div class="filter-modal-body">
                    <div class="filter-group">
                        <label for="kategoriFilterOptions">Kategori</label>
                        <div id="kategoriFilterOptions" class="filter-options">
                            <span class="filter-option-item selected" data-filter-value="">Semua Kategori</span>
                            <span class="filter-option-item" data-filter-value="Fiksi">Fiksi</span>
                            <span class="filter-option-item" data-filter-value="Non-Fiksi">Non-Fiksi</span>
                        </div>
                    </div>
                    <div class="filter-group">
                        <label for="stokFilterOptions">Stok</label>
                        <div id="stokFilterOptions" class="filter-options">
                            <span class="filter-option-item selected" data-filter-value="">Semua Stok</span>
                            <span class="filter-option-item" data-filter-value="high">Tersedia</span>
                            <span class="filter-option-item" data-filter-value="low">Hampir Habis</span>
                            <span class="filter-option-item" data-filter-value="empty">Habis</span>
                        </div>
                    </div>
                    <div class="filter-group">
                        <label for="genreFilterOptions">Genre</label>
                        <div id="genreFilterOptions" class="filter-options">
                            <span class="filter-option-item selected" data-filter-value="">Semua Genre</span>
                            <span class="filter-option-item" data-filter-value="novel">Novel</span>
                            <span class="filter-option-item" data-filter-value="romansa">Romansa</span>
                            <span class="filter-option-item" data-filter-value="petualangan">Petualangan</span>
                            <span class="filter-option-item" data-filter-value="fantasi">Fantasi</span>
                            <span class="filter-option-item" data-filter-value="misteri/detektif">Misteri/Detektif</span>
                            <span class="filter-option-item" data-filter-value="horor">Horor</span>
                            <span class="filter-option-item" data-filter-value="fiksi_ilmiah">Fiksi Ilmiah</span>
                            <span class="filter-option-item" data-filter-value="sejarah_fiksi">Sejarah Fiksi</span>
                            <span class="filter-option-item" data-filter-value="drama">Drama</span>
                            <span class="filter-option-item" data-filter-value="pengembangan_diri">Pengembangan Diri</span>
                            <span class="filter-option-item" data-filter-value="esai">Esai</span>
                            <span class="filter-option-item" data-filter-value="biografi_autobiografi">Biografi/Autobiografi</span>
                            <span class="filter-option-item" data-filter-value="buku_agama">Buku Agama</span>
                            <span class="filter-option-item" data-filter-value="buku_sejarah">Buku Sejarah</span>
                            <span class="filter-option-item" data-filter-value="buku_kesehatan">Buku Kesehatan</span>
                            <span class="filter-option-item" data-filter-value="bisnis_ekonomi">Bisnis & Ekonomi</span>
                            <span class="filter-option-item" data-filter-value="buku_panduan">Buku Panduan</span>
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
    <script src="{{ asset('asset/js/admin/buku/halaman_buku.js') }}"></script>
@endpush
