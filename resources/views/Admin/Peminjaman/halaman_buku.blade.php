@extends('Admin/Layouts.dashboard')

@section('title', 'Peminjaman - SIPERPUS')

@push('styles')
    @vite('resources/css/admin/Peminjaman/peminjaman.css')
    @vite('resources/css/admin/sidebar/sidebar_tes.css')
@endpush

@section('content')
    <main class="main-content">
        <header class="navbar">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="header-left">
                <i id="sidebar-toggle" class="fas fa-bars"></i>
                <h1>Peminjaman</h1>
            </div>
            <div class="header-right">
                <i class="fas fa-bell notification-bell"></i>
                <div class="user-profile">
                    <i class="fas fa-user-circle"></i>
                </div>
            </div>
        </header>

        <section class="content" >
        <div class="peminjaman-wrapper">
            <div class="form-container">
                <div class="custom-card">
                    <div class="custom-card-header">
                        <i class="fas fa-address-card"></i>
                        <h3>Informasi Peminjaman</h3>
                    </div>
                    <div class="form-group">
                        <label>Nama Anggota:</label>
                        <input type="text" class="custom-input" placeholder="Cari nama anggota...">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Tanggal Pinjam:</label>
                            <input type="date" class="custom-input">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Kembali:</label>
                            <input type="date" class="custom-input">
                        </div>
                    </div>
                </div>

                <div class="custom-card">
                    <div class="custom-card-header">
                        <i class="fas fa-book-medical"></i>
                        <h3>Tambah Buku</h3>
                    </div>
                    <div class="form-group" style="margin-bottom: 25px;">
                        <label>Judul Buku:</label>
                        <input type="text" class="custom-input" placeholder="Cari judul buku...">
                    </div>
                    <button class="btn-simpan">SIMPAN PEMINJAMAN</button>
                </div>
            </div>

            <div class="custom-card">
                <div class="custom-card-header" style="border-bottom: 2px solid var(--border-light); margin-bottom: 20px;">
                    <h3 class="table-title-style">Semua Peminjaman Buku</h3>
                </div>

                <div class="card-body">
                    <div class="filter-controls">
                        <button id="btnOpenFilter" class="filter-btn">
                            <i class="fas fa-filter"></i> Filter
                        </button>

                        <div id="filterModalOverlay" class="custom-modal-overlay">
                            <div class="filter-modal">
                                <div class="filter-modal-header">
                                    <h3>Filter Peminjaman</h3>
                                    <span id="btnCloseFilter" class="filter-modal-close">&times;</span>
                                </div>
                                <div class="filter-modal-body">
                                    <div class="filter-group">
                                        <label>Tanggal Pinjam</label>
                                        <input type="date" id="filterTglPinjam" class="filter-input">
                                    </div>
                                    <div class="filter-group">
                                        <label>Batas Kembali</label>
                                        <input type="date" id="filterTglKembali" class="filter-input">
                                    </div>
                                </div>
                                <div class="filter-modal-actions">
                                    <button id="btnResetFilter" class="btn-filter-modal btn-reset">Reset</button>
                                    <button id="btnApplyFilter" class="btn-filter-modal btn-apply">Terapkan Filter</button>
                                </div>
                            </div>
                        </div>

                        <div class="search-wrapper">
                            <i class="fas fa-search"></i>
                            <input type="text" class="search-input" placeholder="Cari Nama Anggota...">
                        </div>
                    </div>

                    <div style="overflow-x: auto;">
                        <table id="peminjamanTable">
                            <thead>
                                <tr>
                                    <th style="width: 8%;">NO</th>
                                    <th style="width: 15%;">ID PEMINJAMAN</th>
                                    <th style="width: 22%;">NAMA ANGGOTA</th>
                                    <th style="width: 15%;">TGL PINJAM</th>
                                    <th style="width: 15%;">BATAS KEMBALI</th>
                                    <th style="width: 15%; text-align: center;">STATUS</th>
                                    <th style="width: 10%; text-align: center;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>P0001</td>
                                    <td>Dinda Permata</td>
                                    <td>10/04/2025</td>
                                    <td>17/04/2025</td>
                                    <td style="text-align: center;"><span class="status-badge">DIPINJAM</span></td>
                                    <td style="text-align: center;">
                                        <div class="action-icons">
                                            <button class="btn-action btn-view"><i class="fas fa-eye"></i></button>
                                            <button class="btn-action btn-return" onclick="openReturnModal('P0001')"><i
                                                    class="fas fa-arrow-right"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="pagination" class="pagination-container"></div>
                </div>
            </div>
            </div>
        </section>
    </main>

    <div id="returnModalOverlay" class="modal-overlay">
        <div class="modal-confirm">
            <div class="icon-box">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h4>Konfirmasi Kembali</h4>
            <p>Apakah Anda yakin ingin memproses pengembalian buku untuk ID: <span id="displayID"
                    style="font-weight: 700;"></span>?</p>
            <div class="confirm-actions">
                <button onclick="closeReturnModal()" class="btn-modal btn-cancel">Batal</button>
                <button id="btnConfirmReturn" class="btn-modal btn-confirm">Proses</button>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @vite('resources/js/admin/buku/halaman_buku.js')
@endpush