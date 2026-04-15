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
                    <h3>Semua Anggota</h3>
                </div>
                <div class="card-body">
                    <div class="filter-controls">
                        <button id="openFilterModal" class="filter-button"><i class="fas fa-filter"></i> Filter</button>
                        <div class="search-wrapper">
                            <i class="fas fa-search"></i>
                            <input type="text" id="memberSearch" placeholder="Cari Nama...">
                        </div>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%;">No</th>
                                    <th class="text-center" style="width: 8%;">Foto</th>
                                    <th style="width: 25%;">Nama</th>
                                    <th style="width: 17%;">No Induk</th>
                                    <th style="width: 15%;">Kelas</th>
                                    <th style="width: 15%; padding-left: 25px;">Kategori</th>
                                    <th class="text-center" style="width: 15%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="memberTableBody">
                            </tbody>
                        </table>
                    </div>
                    <div id="pagination" class="pagination-container"></div>
                </div>
            </div>
        </section>
    </main>

    <!-- ====== Filter Modal ====== -->
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
                        <span class="filter-option-item" data-filter-value="Pelajar">Pelajar</span>
                        <span class="filter-option-item" data-filter-value="Guru">Guru</span>
                    </div>
                </div>

                <div class="filter-group" id="jurusanFilterGroup">
                    <label>Kategori Jurusan:</label>
                    <div class="filter-options" id="jurusanFilterOptions">
                        <span class="filter-option-item selected" data-filter-value="">Semua Jurusan</span>
                    </div>
                </div>

                <div class="filter-group" id="kelasFilterGroup">
                    <label>Kelas:</label>
                    <div class="filter-options" id="kelasFilterOptions">
                        <span class="filter-option-item selected" data-filter-value="">Semua Kelas</span>
                    </div>
                </div>
            </div>

            <div class="filter-modal-actions">
                <button id="resetFiltersBtn" class="btn btn-secondary">Reset</button>
                <button id="applyFiltersBtn" class="btn btn-primary">Terapkan</button>
            </div>
        </div>
    </div>

    <!-- Modal Detail Anggota -->
    <div id="memberDetailModal" class="modal-overlay" onclick="closeDetailModalOutside(event)">
        <div class="mdc-card" onclick="event.stopPropagation()">
            <div class="mdc-header">
                <span class="mdc-close" onclick="closeDetailModal()"><i class="fas fa-times"></i></span>
                <div class="mdc-profile-wrapper">
                    <img id="mdc-foto" class="mdc-profile-img" src="" alt="Foto Anggota">
                </div>
            </div>

            <div class="mdc-body">
                <h2 id="mdc-nama" class="mdc-name">Memuat...</h2>
                <span id="mdc-username" class="mdc-username">@memuat</span>

                <div class="mdc-badges">
                    <span id="mdc-kategori" class="mdc-badge mdc-badge-primary">...</span>
                    <span id="mdc-status" class="mdc-badge mdc-badge-success">...</span>
                </div>

                <div class="mdc-stats">
                    <div class="mdc-stat-box">
                        <i class="fas fa-book-reader"></i>
                        <span>Pinjaman Aktif</span>
                        <strong id="mdc-pinjaman-aktif">0</strong>
                    </div>
                    <div class="mdc-stat-box">
                        <i class="fas fa-history"></i>
                        <span>Total Pinjaman</span>
                        <strong id="mdc-total-pinjaman">0</strong>
                    </div>
                </div>

                <div class="mdc-info-grid">
                    <div class="mdc-info-item">
                        <div class="mdc-info-icon"><i class="fas fa-id-card"></i></div>
                        <div class="mdc-info-text">
                            <label>Nomor Induk</label>
                            <p id="mdc-no-induk">-</p>
                        </div>
                    </div>

                    <div class="mdc-info-item">
                        <div class="mdc-info-icon"><i class="fas fa-envelope"></i></div>
                        <div class="mdc-info-text">
                            <label>Email</label>
                            <p id="mdc-email">-</p>
                        </div>
                    </div>

                    <div class="mdc-info-item">
                        <div class="mdc-info-icon"><i class="fas fa-phone"></i></div>
                        <div class="mdc-info-text">
                            <label>No. Telepon</label>
                            <p id="mdc-telepon">-</p>
                        </div>
                    </div>

                    <div class="mdc-info-item">
                        <div class="mdc-info-icon"><i class="fas fa-venus-mars"></i></div>
                        <div class="mdc-info-text">
                            <label>Jenis Kelamin</label>
                            <p id="mdc-jk">-</p>
                        </div>
                    </div>

                    <div class="mdc-info-item mdc-col-span-2">
                        <div class="mdc-info-icon"><i class="fas fa-graduation-cap"></i></div>
                        <div class="mdc-info-text">
                            <label>Kelas & Jurusan</label>
                            <p id="mdc-kelas-jurusan">-</p>
                        </div>
                    </div>

                    <div class="mdc-info-item mdc-col-span-2">
                        <div class="mdc-info-icon"><i class="fas fa-calendar-check"></i></div>
                        <div class="mdc-info-text">
                            <label>Tanggal Bergabung</label>
                            <p id="mdc-tgl-gabung">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== Delete Modal ===== -->
    <div id="deleteModalOverlay" class="modal-overlay">
        <div class="modal-confirm">
            <div class="icon-box">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h4>Apakah Anda Yakin?</h4>
            <p>Data anggota ini akan dihapus secara permanen dari sistem SIPERPUS.</p>
            <div class="confirm-actions">
                <button onclick="closeDeleteModal()" class="btn btn-cancel">Batal</button>
                <button id="btnConfirmDelete" class="btn btn-confirm">Hapus</button>
            </div>
        </div>
    </div>

    <!-- ===== Berhasil Menghapus Anggota Modal ===== -->
    <div id="deleteSuccesModal" class="modal-overlay">
        <div class="modal-confirm">
            <div class="icon-box">
                <i class="fas fa-trash-alt"></i>
            </div>
            <h4>Data Dihapus!</h4>
            <p>Data anggota telah berhasil dihapus secara permanen dari sistem SIPERPUS.</p>
            <div class="confirm-actions">
                <button onclick="closeDeleteSuccesModal()" class="btn-success">Mengerti</button>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    @vite('resources/js/admin/anggota/daftar_anggota.js')
@endpush