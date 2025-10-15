<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku - SIPERPUS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Global Styles & Variables */
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
        }
        
         :root {
            --primary-color: #5c6ac4;
            --secondary-color: #f4f6fc;
            --text-color: #333;
            --sidebar-bg: #fff;
            --sidebar-text: #333;
            --sidebar-active-bg: #e6e9f0;
            --card-bg: #fff;
            --border-radius: 12px;
            --box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        
        body {
            background: var(--secondary-color);
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .container {
            display: flex;
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        /* Main Content & Navbar */
        
        .main-content {
            flex: 1;
            padding: 30px;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 15px 20px;
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        #sidebar-toggle {
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--primary-color);
            margin-right: 20px;
        }
        
        .header-left {
            display: flex;
            align-items: center;
        }
        
        .header-left h1 {
            font-size: 1.8rem;
            color: var(--primary-color);
        }
        
        .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .header-right .fa-bell {
            font-size: 1.2rem;
            color: #777;
            cursor: pointer;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-profile .fa-user-circle {
            font-size: 2rem;
            color: var(--primary-color);
        }
        
        .user-profile span {
            font-weight: 600;
        }
        
        .content {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }
        
        .card {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 25px;
            display: flex;
            flex-direction: column;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        
        .card-header h3 {
            font-size: 1.2rem;
            color: var(--primary-color);
        }
        
        .card-body {
            flex-grow: 1;
            overflow-y: auto;
        }
        
        .table-container {
            margin-top: 20px;
        }
        
        .table-container h4 {
            font-size: 1rem;
            color: #555;
            margin-bottom: 10px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }
        
        th,
        td {
            text-align: left;
            padding: 12px 8px;
            border-bottom: 1px solid #ddd;
        }
        
        thead th {
            background-color: #f2f2f2;
            font-weight: 600;
            color: #555;
        }
        
        tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        .btn {
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: #fff;
            border: 1px solid var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #4b59b1;
        }
        
        .member-photo {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            background-color: #eee;
            display: block;
            border: 1px solid #ddd;
        }
        
        .action-icons a {
            color: #777;
            margin-right: 10px;
            text-decoration: none;
        }
        
        .action-icons a:hover {
            color: var(--primary-color);
        }
        /* Filter Controls */
        
        .filter-controls {
            display: flex;
            gap: 15px;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .filter-controls .filter-button {
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            cursor: pointer;
            color: #555;
            transition: background-color 0.2s, border-color 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .filter-controls .filter-button:hover {
            background-color: #f0f0f0;
            border-color: var(--primary-color);
        }
        
        #bookSearch {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        /* Modal Styles */
        
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }
        
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .filter-modal {
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            display: flex;
            flex-direction: column;
            transform: translateY(-20px);
            transition: transform 0.3s ease;
        }
        
        .modal-overlay.active .filter-modal {
            transform: translateY(0);
        }
        
        .filter-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 30px 30px 20px 30px;
            border-bottom: 1px solid var(--secondary-color);
        }
        
        .filter-modal-header h3 {
            font-size: 1.5rem;
            color: var(--primary-color);
        }
        
        .filter-modal-close {
            font-size: 1.5rem;
            color: #777;
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .filter-modal-close:hover {
            color: #333;
        }
        
        .filter-modal-body {
            padding: 30px;
            flex-grow: 1;
            overflow-y: auto;
        }
        
        .filter-group {
            margin-bottom: 25px;
        }
        
        .filter-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--primary-color);
            font-size: 1.1rem;
        }
        
        .filter-options {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .filter-option-item {
            padding: 8px 15px;
            border: 1px solid #ccc;
            border-radius: 20px;
            cursor: pointer;
            background-color: #f9f9f9;
            transition: background-color 0.2s, border-color 0.2s, color 0.2s;
        }
        
        .filter-option-item:hover {
            background-color: var(--sidebar-active-bg);
            border-color: var(--primary-color);
        }
        
        .filter-option-item.selected {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: #fff;
        }
        
        .filter-modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            padding: 20px 30px 30px 30px;
            border-top: 1px solid var(--secondary-color);
        }
        
        .btn-secondary {
            background-color: #ccc;
            color: #333;
            border: 1px solid #ccc;
        }
        
        .btn-secondary:hover {
            background-color: #bbb;
            border-color: #bbb;
        }
        
        .stock-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #fff;
            text-align: center;
        }
        
        .stock-badge.high {
            background-color: #12b76a;
            /* Hijau */
        }
        
        .stock-badge.low {
            background-color: #f79009;
            /* Kuning/Oranye */
        }
        
        .stock-badge.empty {
            background-color: #f04438;
            /* Merah */
        }
    </style>
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src="siperpus.png" alt="SIPERPUS" />
                <h2>SIPERPUS</h2>
            </div>
            <nav>
                <ul>
                    <li><a href="dashboard.html"><i class="fas fa-chart-line"></i> <span>Dashboard</span></a></li>
                    <li>
                        <a href="anggota.html"><i class="fas fa-users"></i> <span>Anggota</span></a>
                    </li>
                    <li class="active">
                        <a href="#"><i class="fas fa-book"></i> <span>Manajemen Buku</span> <i class="fas fa-caret-down"></i></a>
                        <ul class="submenu" style="display: block;">
                            <li class="active"><a href="buku.html">Daftar Buku</a></li>
                            <li><a href="#">Kategori</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-clock"></i> <span>Antrian Pre-Order</span> <i class="fas fa-caret-down"></i></a>
                        <ul class="submenu">
                            <li><a href="antrian.html">Daftar Antrian</a></li>
                            <li><a href="#">Konfirmasi Ketersediaan</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-exchange-alt"></i> <span>Transaksi</span> <i class="fas fa-caret-down"></i></a>
                        <ul class="submenu">
                            <li><a href="transaksi.html">Peminjaman</a></li>
                            <li><a href="#">Pengembalian</a></li>
                            <li><a href="#">Riwayat</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-file-alt"></i> <span>Laporan</span> <i class="fas fa-caret-down"></i></a>
                        <ul class="submenu">
                            <li><a href="laporan.html">Statistik</a></li>
                            <li><a href="#">Buku Populer</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="settings">
                <a href="#"><i class="fas fa-cog"></i> <span>Pengaturan</span></a>
            </div>
        </aside>
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
                        <span>Admin</span>
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
                                        <th>Gambar Buku</th>
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
    </div>

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

    <script>
        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const navLinksWithSubmenu = document.querySelectorAll('.sidebar nav ul li a');
        const modalOverlay = document.getElementById('modalOverlay');
        const filterButton = document.getElementById('filterButton');
        const closeModalButton = document.getElementById('closeModal');
        const applyFiltersBtn = document.getElementById('applyFiltersBtn');
        const resetFiltersBtn = document.getElementById('resetFiltersBtn');
        const bookSearchInput = document.getElementById('bookSearch');
        const kategoriFilterOptionsDiv = document.getElementById('kategoriFilterOptions');
        const stokFilterOptionsDiv = document.getElementById('stokFilterOptions');
        const genreFilterOptionsDiv = document.getElementById('genreFilterOptions');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });

        navLinksWithSubmenu.forEach(link => {
            link.addEventListener('click', (e) => {
                const submenu = link.nextElementSibling;
                const parentLi = link.parentElement;

                if (submenu) {
                    e.preventDefault();

                    if (parentLi.classList.contains('active')) {
                        submenu.style.display = 'none';
                        parentLi.classList.remove('active');
                    } else {
                        document.querySelectorAll('.sidebar nav ul .submenu').forEach(otherSubmenu => {
                            otherSubmenu.style.display = 'none';
                            otherSubmenu.parentElement.classList.remove('active');
                        });

                        submenu.style.display = 'block';
                        parentLi.classList.add('active');
                    }
                }
            });
        });

        filterButton.addEventListener('click', () => {
            modalOverlay.classList.add('active');
        });

        closeModalButton.addEventListener('click', () => {
            modalOverlay.classList.remove('active');
        });

        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                modalOverlay.classList.remove('active');
            }
        });

        const books = [{
            judul: 'Laskar Pelangi',
            pengarang: 'Andrea Hirata',
            penerbit: 'Bentang Pustaka',
            kategori: 'Fiksi',
            genre: 'Novel',
            stok: 10
        }, {
            judul: 'Filosofi Teras',
            pengarang: 'Henry Manampiring',
            penerbit: 'Kompas',
            kategori: 'Non-Fiksi',
            genre: 'Pengembangan Diri',
            stok: 5
        }, {
            judul: 'Atomic Habits',
            pengarang: 'James Clear',
            penerbit: 'Gramedia Pustaka Utama',
            kategori: 'Non-Fiksi',
            genre: 'Petualangan',
            stok: 2
        }, {
            judul: 'Bumi Manusia',
            pengarang: 'Pramoedya Ananta Toer',
            penerbit: 'Hasta Mitra',
            kategori: 'Fiksi',
            genre: 'Novel Sejarah',
            stok: 0
        }, {
            judul: 'Laut Bercerita',
            pengarang: 'Leila S. Chudori',
            penerbit: 'Kepustakaan Populer Gramedia',
            kategori: 'Fiksi',
            genre: 'Novel Sejarah',
            stok: 12
        }, {
            judul: 'Dune',
            pengarang: 'Frank Herbert',
            penerbit: 'Berkley Publishing Group',
            kategori: 'Fiksi',
            genre: 'Fiksi Ilmiah',
            stok: 8
        }, {
            judul: 'The Hobbit',
            pengarang: 'J.R.R. Tolkien',
            penerbit: 'Allen & Unwin',
            kategori: 'Fiksi',
            genre: 'Fantasi',
            stok: 7
        }, {
            judul: 'It',
            pengarang: 'Stephen King',
            penerbit: 'Viking Press',
            kategori: 'Fiksi',
            genre: 'Horor',
            stok: 3
        }, {
            judul: 'Steve Jobs',
            pengarang: 'Walter Isaacson',
            penerbit: 'Simon & Schuster',
            kategori: 'Non-Fiksi',
            genre: 'Biografi',
            stok: 6
        }, {
            judul: 'Komik Jagoan Cilik',
            pengarang: 'Budi Hartono',
            penerbit: 'Elex Media Komputindo',
            kategori: 'Fiksi',
            genre: 'Komik',
            stok: 15
        }, {
            judul: 'A Brief History of Time',
            pengarang: 'Stephen Hawking',
            penerbit: 'Bantam Books',
            kategori: 'Non-Fiksi',
            genre: 'Sains',
            stok: 4
        }, ];

        function populateBooksTable(filteredBooks = books) {
            const bookTableBody = document.getElementById('bookTableBody');
            bookTableBody.innerHTML = '';
            if (filteredBooks.length === 0) {
                bookTableBody.innerHTML = '<tr><td colspan="9" style="text-align: center;">Tidak ada buku yang ditemukan.</td></tr>';
                return;
            }

            filteredBooks.forEach((book, index) => {
                const row = document.createElement('tr');
                let stockClass = 'high';
                if (book.stok <= 5 && book.stok > 0) {
                    stockClass = 'low';
                } else if (book.stok === 0) {
                    stockClass = 'empty';
                }
                row.innerHTML = `
                <td>${index + 1}</td>
                <td><img src="https://placehold.co/50x70/png" alt="Cover Buku ${book.judul}" class="book-cover"></td>
                <td>${book.judul}</td>
                <td>${book.pengarang}</td>
                <td>${book.penerbit}</td>
                <td>${book.kategori}</td>
                <td>${book.genre}</td>
                <td><span class="stock-badge ${stockClass}">${book.stok}</span></td>
                <td>
                    <a href="#" style="color: var(--primary-color); margin-right: 5px;"><i class="fas fa-edit"></i></a>
                    <a href="#" style="color: #e74c3c;"><i class="fas fa-trash-alt"></i></a>
                </td>
            `;
                bookTableBody.appendChild(row);
            });
        }

        function filterBooks() {
            const searchQuery = bookSearchInput.value.toLowerCase();
            const selectedKategori = kategoriFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;
            const selectedStok = stokFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;
            const selectedGenre = genreFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;

            const filteredBooks = books.filter(book => {
                const matchesSearch = book.judul.toLowerCase().includes(searchQuery) ||
                    book.pengarang.toLowerCase().includes(searchQuery) ||
                    book.penerbit.toLowerCase().includes(searchQuery);
                const matchesKategori = selectedKategori === '' || book.kategori.toLowerCase() === selectedKategori.toLowerCase();
                const matchesStok = selectedStok === '' ||
                    (selectedStok === 'high' && book.stok > 5) ||
                    (selectedStok === 'low' && book.stok >= 1 && book.stok <= 5) ||
                    (selectedStok === 'empty' && book.stok === 0);
                const matchesGenre = selectedGenre === '' || book.genre.toLowerCase() === selectedGenre.toLowerCase();

                return matchesSearch && matchesKategori && matchesStok && matchesGenre;
            });

            populateBooksTable(filteredBooks);
        }

        [kategoriFilterOptionsDiv, stokFilterOptionsDiv, genreFilterOptionsDiv].forEach(filterDiv => {
            filterDiv.addEventListener('click', (e) => {
                if (e.target.classList.contains('filter-option-item')) {
                    filterDiv.querySelectorAll('.filter-option-item').forEach(opt => opt.classList.remove('selected'));
                    e.target.classList.add('selected');
                }
            });
        });

        resetFiltersBtn.addEventListener('click', () => {
            kategoriFilterOptionsDiv.querySelector('.filter-option-item[data-filter-value=""]').click();
            stokFilterOptionsDiv.querySelector('.filter-option-item[data-filter-value=""]').click();
            genreFilterOptionsDiv.querySelector('.filter-option-item[data-filter-value=""]').click();
            bookSearchInput.value = '';
            filterBooks();
        });

        applyFiltersBtn.addEventListener('click', () => {
            filterBooks();
            modalOverlay.classList.remove('active');
        });

        bookSearchInput.addEventListener('keyup', filterBooks);

        window.onload = () => {
            populateBooksTable();
            filterBooks();
        };
    </script>
</body>

</html>