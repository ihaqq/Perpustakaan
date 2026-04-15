@extends('Admin/Layouts.dashboard')

@section('title', 'Halaman Buku')

@push('styles')
    @vite('resources/css/admin/buku/halaman_buku.css')
    @vite('resources/css/admin/sidebar/sidebar_tes.css')
@endpush

@section('content')
    <main class="main-content">
        <header class="navbar">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="header-left">
                <i id="sidebar-toggle" class="fas fa-bars"></i>
                <h1>Daftar Buku</h1>
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
                    <h3>Semua Koleksi Buku</h3>
                    <div style="display: flex; gap: 10px;">
                        <button onclick="openAddBookModal()" class="btn btn-primary btn-icon">
                            <i class="fas fa-plus-circle"></i>Tambah Buku Baru
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="filter-controls">
                        <button id="filterButton" class="filter-button"><i class="fas fa-filter"></i> Filter</button>
                        <div class="search-wrapper">
                            <i class="fas fa-search"></i>
                            <input type="text" id="bookSearch" placeholder="Cari buku...">
                        </div>
                    </div>
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 5%; text-align: center;">No</th>
                                    <th style="width: 10%;">Kode Buku</th>
                                    <th style="width: 10%; text-align: center;">Cover Buku</th>
                                    <th style="width: 25%;">Judul & Tahun</th>
                                    <th style="width: 15%;">Kategori</th>
                                    <th style="width: 15%;">Genre</th>
                                    <th style="width: 8%;">Stok</th>
                                    <th style="width: 12%; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="bookTableBody">
                            </tbody>
                        </table>
                    </div>
                    <div id="pagination" class="pagination-container"></div>
                </div>
            </div>
        </section>
    </main>

        <!-- ===== Filter Book Modal ===== -->
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
                            <span class="filter-option-item" data-filter-value="Non Fiksi">Non Fiksi</span>
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
                        </div>
                    </div>
                </div>
                <div class="filter-modal-actions">
                    <button id="resetFiltersBtn" class="btn btn-secondary">Reset</button>
                    <button id="applyFiltersBtn" class="btn btn-primary">Terapkan</button>
                </div>
            </div>
        </div>

        <!-- ===== Add Book Modal ===== -->
        <div id="addBookModalOverlay" class="modal-overlay">
            <div class="add-modal-container">
                
                <div class="add-modal-header">
                    <div class="add-modal-title">
                        <div class="icon-box-header">
                            <i class="fas fa-book-open-reader icon-header"></i>
                        </div>
                        <h2>Tambah Buku</h2>
                    </div>
                    <button type="button" onclick="closeAddBookModal()" class="btn-close-modal">&times;</button>
                </div>

                <div class="add-modal-body custom-scroll">
                    <form id="addBookForm" class="add-book-form">
                        <input type="hidden" id="editBookId" value="">
                        <div class="form-row form-row-7-5">
                            <div class="form-group">
                                <label>Judul Buku:</label>
                                <input type="text" id="add-judul" class="input-style" >
                            </div>
                            <div class="form-group">
                                <label>Kategori:</label>
                                <div class="radio-group">
                                    <label class="radio-label group">
                                        <input type="radio" name="kat" value="Fiksi" checked> 
                                        <span>Fiksi</span>
                                    </label>
                                    <label class="radio-label group">
                                        <input type="radio" name="kat" value="Non Fiksi"> 
                                        <span>Non-Fiksi</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row form-row-3-cols">
                            <div class="form-group">
                                <label>Pengarang:</label>
                                <input type="text" id="add-pengarang" class="input-style" >
                            </div>
                            <div class="form-group">
                                <label>Penerbit:</label>
                                <input type="text" id="add-penerbit" class="input-style" >
                            </div>
                            <div class="form-group">
                                <label>Genre:</label>
                                <div class="select-wrapper">
                                    <select id="genreSelect" class="input-style" >
                                        <option value="" disabled selected>Pilih...</option>
                                        <option>Novel</option>
                                        <option>Biografi</option>
                                        <option>Edukasi</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row form-row-3-cols">
                            <div class="form-group">
                                <label>Stok:</label>
                                <input type="number" id="add-stok" class="input-style" min="0" >
                            </div>
                            <div class="form-group">
                                <label>Tahun Terbit:</label>
                                <input type="number" id="add-tahun_terbit" class="input-style" min="1900" >
                            </div>
                            <div class="form-group">
                                <label>Bahasa:</label>
                                <input type="text" id="add-bahasa" class="input-style" >
                            </div>
                        </div>

                        <div class="form-row form-row-2-cols">
                            <div class="form-group">
                                <label>Lokasi Rak:</label>
                                <input type="text" id="add-lokasi_rak" class="input-style" >
                            </div>
                            <div class="form-group">
                                <label>Jumlah Halaman:</label>
                                <input type="number" id="add-jumlah_halaman" class="input-style" min="1" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Sinopsis:</label>
                            <textarea id="add-sinopsis" rows="3" class="input-style textarea-style" ></textarea>
                        </div>

                        <div class="form-group">
                            <label>Cover Buku:</label>
                            <div class="upload-area" onclick="document.getElementById('fileInput').click()">
                                <input type="file" id="fileInput" accept="image/*" onchange="previewImage(this)">
                                
                                <div id="previewContainer" class="preview-container">
                                    <img id="imagePreview" src="#" alt="Preview">
                                    <p>Klik untuk ganti gambar</p>
                                </div>

                                <div id="placeholderContent" class="placeholder-content">
                                    <i class="fas fa-image"></i>
                                    <p>Tarik gambar ke sini atau <span>Klik untuk unggah</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="button" onclick="closeAddBookModal()" class="btn-cancel">Batal</button>
                            <button type="submit" id="btnSubmitBook" class="btn-save">
                                <i class="far fa-save text-lg"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ===== Berhasil Menambahkan Buku Modal ===== -->
         <div id="addSuccesModal" class="modal-overlay">
            <div class="modal-confirm">
                <div class="icon-box">
                    <i class="fas fa-check"></i>
                </div>
                <h4>Berhasil!</h4>
                <p>Data buku telah berhasil disimpan di dalam sistem SIPERPUS.</p>
                <div class="confirm-actions">
                    <button onclick="closeSuccesAddBookmodal()" class="btn-success">Mengerti</button>
                </div>
            </div>
         </div>

        <!-- ===== Berhasil Mengubah Data Buku Modal ===== -->
         <div id="addSuccesEditModal" class="modal-overlay">
            <div class="modal-confirm">
                <div class="icon-box">
                    <i class="fas fa-check"></i>
                </div>
                <h4>Perubahan Disimpan!</h4>
                <p>Data buku telah berhasil diperbarui dan disimpan ke dalam sistem SIPERPUS.</p>
                <div class="confirm-actions">
                    <button onclick="closeSuccesAddBookmodal()" class="btn-success">Mengerti</button>
                </div>
            </div>
         </div>

        <!-- ===== Gagal Menambah Data Buku Modal ===== -->
         <div id="addFailModal" class="modal-overlay">
            <div class="modal-confirm-fail">
                <div class="icon-box-modal-fail">
                    <i class="fas fa-times"></i>
                </div>
                <h4>Gagal Menambahkan!</h4>
                <p>Terjadi kesalahan sistem. Mohon periksa kembali kelengkapan data buku Anda.</p>
                <div class="confirm-actions-fail">
                    <button onclick="closeSuccesAddBookmodal()" class="btn-fail">Coba Lagi</button>
                </div>
            </div>
         </div>

        <!-- ===== Gagal Update Data Buku Modal ===== -->
         <div id="addFailEditModal" class="modal-overlay">
            <div class="modal-confirm-fail">
                <div class="icon-box-modal-fail">
                    <i class="fas fa-times"></i>
                </div>
                <h4>Gagal Mengubah!</h4>
                <p>Terjadi kesalahan sistem. Mohon periksa kembali kelengkapan data buku Anda..</p>
                <div class="confirm-actions-fail">
                    <button onclick="closeSuccesAddBookmodal()" class="btn-fail">Coba Lagi</button>
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
                <p>Data buku ini akan dihapus secara permanen dari sistem SIPERPUS.</p>
                <div class="confirm-actions">
                    <button onclick="closeDeleteModal()" class="btn btn-cancel">Batal</button>
                    <button id="btnConfirmDelete" class="btn btn-confirm">Hapus</button>
                </div>
            </div>
        </div>

        <!-- ===== Berhasil Menghapus Buku Modal ===== -->
         <div id="deleteSuccesModal" class="modal-overlay">
            <div class="modal-confirm">
                <div class="icon-box">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <h4>Data Dihapus!</h4>
                <p>Data buku telah berhasil dihapus secara permanen dari sistem SIPERPUS.</p>
                <div class="confirm-actions">
                    <button onclick="closeSuccesAddBookmodal()" class="btn-success">Mengerti</button>
                </div>
            </div>
         </div>

        <!-- ==== Detail Modal ==== -->
        <div id="detailModalOverlay" class="detail-modal-overlay">
            <div class="detail-modal-container">
                <div class="detail-modal-header">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div class="detail-header-icon-wrapper">
                            <i class="fas fa-circle-info detail-icon-header" style="font-size: 20px; color: #5c6ac4;"></i>
                        </div>
                        <h2 class="text-[20px] font-bold text-[#5c6ac4]">Detail Buku</h2>
                    </div>
                    <button class="detail-btn-close" onclick="closeDetailModal()">&times;</button>
                </div>

                <div class="detail-modal-body">
                    <div class="detail-modal-visual">
                        <img id="detail-cover" src="https://placehold.co/400x600/5c6ac4/white?text=Cover+Buku" alt="Cover">

                        <div class="detail-stock-panel">
                            <label>Ketersediaan Stok</label>
                            <span id="detail-stok" class="stock-badge"></span>
                            <span class="detail-stock-status" style="color: #636e72;">Eksemplar</span>
                        </div>
                    </div>

                    <div class="detail-modal-info">
                        <span id="detail-kategori" class="detail-category-tag">Kategori</span>
                        <h1 id="detail-judul" class="detail-book-title">Judul Buku</h1>

                        <div class="detail-info-grid">
                            <div class="detail-info-item">
                                <label>Kode Buku</label>
                                <p id="detail-kode_buku">-</p>
                            </div>
                            <div class="detail-info-item">
                                <label>Bahasa</label>
                                <p id="detail-bahasa">-</p>
                            </div>
                            <div class="detail-info-item">
                                <label>Pengarang</label>
                                <p id="detail-pengarang">-</p>
                            </div>
                            <div class="detail-info-item">
                                <label>Penerbit</label>
                                <p id="detail-penerbit">-</p>
                            </div>
                            <div class="detail-info-item">
                                <label>Genre</label>
                                <p id="detail-genre">-</p>
                            </div>
                            <div class="detail-info-item">
                                <label>Tahun Terbit</label>
                                <p id="detail-tahun_terbit">-</p>
                            </div>
                            <div class="detail-info-item">
                                <label>Jumlah Halaman</label>
                                <p id="detail-jumlah_halaman">-</p>
                            </div>
                            <div class="detail-info-item">
                                <label>Lokasi Rak</label>
                                <p id="detail-lokasi_rak">-</p>
                            </div>
                        </div>

                        <div class="detail-synopsis-section">
                            <label>Sinopsis</label>
                            <p id="detail-sinopsis" class="detail-synopsis-text">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('scripts')
    @vite('resources/js/admin/buku/halaman_buku.js')
@endpush
