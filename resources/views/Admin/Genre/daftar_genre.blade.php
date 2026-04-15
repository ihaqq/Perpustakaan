@extends('Admin/Layouts.dashboard')

@section('title', 'Daftar Genre')

@push('styles')
    @vite('resources/css/admin/genre/daftar_genre.css')
    @vite('resources/css/admin/sidebar/sidebar_tes.css')
@endpush

@section('content')
    <main class="main-content">
        <header class="navbar">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="header-left">
                <i id="sidebar-toggle" class="fas fa-bars"></i>
                <h1>Daftar Genre</h1>
            </div>
            <div class="header-right">
                <i class="fas fa-bell notification-bell"></i>
                <div class="user-profile">
                    <i class="fas fa-user-circle"></i>
                </div>
            </div>
        </header>

        <!-- Content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3>Semua Genre Buku</h3>
                    <button onclick="openAddGenreModal()" class="btn-add">
                        <i class="fas fa-plus"></i>Tambah Genre
                    </button>
                </div>

                <!-- Controls Row -->
                <div class="card-body">
                    <div class="controls-row">
                        <div class="search-wrapper">
                            <i class="fas fa-search"></i>
                            <input type="text" id="genreSearch" placeholder="Cari Genre...">
                        </div>
                        <div class="filter-buttons">
                            <button class="btn-filter active">Semua Genre</button>
                            <button class="btn-filter">Fiksi</button>
                            <button class="btn-filter">Non-fiksi</button>
                        </div>
                    </div>

                    <!-- Table Container -->
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th style="width: 20%;">Nama Genre</th>
                                    <th style="width: 15%;">Kategori Buku</th>
                                    <th style="width: 50%;">Deskripsi Genre</th>
                                    <th style="width: 10%; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="genreTableBody">
                            </tbody>
                        </table>
                    </div>
                    <div id="pagination" class="pagination-container"></div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal Tambah Genre -->
    <div id="addGenreModal" class="modal-overlay" onclick="closeOnOverlay(event)" style="display: none;">
        <div class="modal-card">

            <div class="modal-header">
                <div class="modal-title-wrapper">
                    <div class="modal-icon-box">
                        <i class="fas fa-tags modal-icon"></i>
                    </div>
                    <h2 class="modal-title">Tambah Genre</h2>
                </div>
                <p class="modal-subtitle">Tambahkan informasi genre baru ke perpustakaan Anda</p>
            </div>

            <div class="modal-body">
                <form id="addGenreForm" class="modal-form">

                    <div class="form-group">
                        <label class="form-label" for="nama_genre">Nama Genre:</label>
                        <input type="text" id="nama_genre" name="nama_genre" class="form-input"
                            placeholder="Masukkan nama genre (misal: Fantasi, Sejarah)">
                        <span class="error-msg" id="error-nama_genre"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="kategori_buku">Kategori:</label>
                        <div class="select-wrapper">
                            <select id="kategori_buku" name="kategori_buku" class="form-input cursor-pointer">
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="Fiksi">Fiksi</option>
                                <option value="Non Fiksi">Non Fiksi</option>
                            </select>
                        </div>
                        <span class="error-msg" id="error-kategori_buku"></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="deskripsi">Deskripsi Genre:</label>
                        <textarea id="deskripsi" name="deskripsi" rows="3" maxlength="130" class="form-input resize-none"
                            placeholder="Tuliskan deskripsi singkat mengenai genre ini..."></textarea>

                        <div class="char-counter-wrapper">
                            <span class="error-msg" id="error-deskripsi" style="flex-grow: 1;"></span>
                            <p id="charLimitWarn" class="char-limit-warn hidden">
                                <i class="fas fa-exclamation-circle"></i> Maksimal 130 karakter!
                            </p>
                            <div class="char-counter-text">
                                <span id="charCount">0</span>/130
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" onclick="closeAddGenreModal()"
                            class="btn-cancel">Batal</button>
                        <button type="submit" id="btnSubmitGenre" class="btn-save">
                            <i class="far fa-save text-lg"></i> Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- ===== Delete Modal ===== -->
    <div id="deleteModalOverlay" class="modal-overlay" onclick="closeOnOverlay(event)" style="display: none;">
        <div class="modal-confirm">
            <div class="icon-box">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h4>Apakah Anda Yakin?</h4>
            <p>Data genre ini akan dihapus secara permanen dari sistem SIPERPUS.</p>
            <div class="confirm-actions">
                <button onclick="closeDeleteModal()" class="btn btn-cancel">Batal</button>
                <button id="btnConfirmDelete" class="btn btn-confirm">Hapus</button>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    @vite('resources/js/admin/genre/daftar_genre.js')
@endpush