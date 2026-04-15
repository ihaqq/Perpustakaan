@extends('Admin/Layouts.dashboard') {{-- Ganti dengan nama layout utama Anda --}}

@section('title', 'Peminjaman - SIPERPUS')

@push('styles')
    @vite('resources/css/admin/sidebar/sidebar_tes.css')
    <!-- @vite('resources/css/admin/buku/halaman_buku.css') -->
    <style>
        /* --- SCOPED CSS: Hanya berlaku di dalam .peminjaman-wrapper --- */
        .peminjaman-wrapper {
            --primary: #5c6ac4;
            --primary-hover: #4a55a2;
            --icon-bg-light: #eef0ff;
            --bg-body: #f7f9ff;
            --card-white: #ffffff;
            --text-blue: #4854a0;
            --text-muted: #8e99af;
            --border-light: #eceef3;
            --radius-card: 16px;
            --radius-input: 10px;
            --radius-icon: 8px;
            --cancel-btn-color: #CCCCCC;

            font-family: 'Poppins', 'Segoe UI', sans-serif;
            padding: 20px 0;
        }

        /* Form Container */
        .peminjaman-wrapper .form-container {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .peminjaman-wrapper .custom-card {
            background: var(--card-white);
            border-radius: var(--radius-card);
            padding: 22px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.02);
        }

        .peminjaman-wrapper .custom-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--border-light);
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .peminjaman-wrapper .custom-card-header h3 {
            font-size: 16px;
            color: var(--text-blue);
            font-weight: 600;
            margin: 0;
        }

        .peminjaman-wrapper .custom-card-header i {
            color: var(--text-blue);
            font-size: 0.95rem;
            background-color: var(--icon-bg-light);
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-icon);
        }

        .peminjaman-wrapper .form-group {
            margin-bottom: 15px;
        }

        .peminjaman-wrapper .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-blue);
            margin-bottom: 8px;
        }

        .peminjaman-wrapper .custom-input {
            width: 100%;
            padding: 10px 15px;
            border: 1.2px solid #e0e6ed;
            border-radius: var(--radius-input);
            font-size: 0.85rem;
            color: #555;
            background: #fff;
            outline: none;
            transition: 0.2s;
        }

        .peminjaman-wrapper .custom-input:focus,
        .peminjaman-wrapper .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(92, 106, 196, 0.1);
        }

        .peminjaman-wrapper .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .peminjaman-wrapper .btn-simpan {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 12px;
            border-radius: var(--radius-input);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .peminjaman-wrapper .btn-simpan:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
        }

        /* Tabel Styles */
        .peminjaman-wrapper .table-title-style {
            font-size: 1.2rem !important;
            color: var(--primary) !important;
            margin: 0;
            font-weight: 600;
        }

        .peminjaman-wrapper .filter-controls {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .peminjaman-wrapper .filter-btn {
            padding: 10px 18px;
            border: 1px solid #ccc;
            background: white;
            border-radius: 8px;
            font-size: 0.85rem;
            color: #555;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.3s;
        }

        .peminjaman-wrapper .search-wrapper {
            position: relative;
            flex: 1;
        }

        .peminjaman-wrapper .search-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            font-size: 0.9rem;
        }

        .peminjaman-wrapper .search-input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 0.85rem;
            outline: none;
            transition: 0.3s;
        }

        .peminjaman-wrapper table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .peminjaman-wrapper thead th {
            text-align: left;
            padding: 12px 15px;
            background: #f2f2f2;
            color: #555;
            font-size: 0.85rem;
            font-weight: 600;
            border-bottom: 2px solid #eee;
        }

        .peminjaman-wrapper td {
            padding: 15px;
            font-size: 16px;
            color: #333;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .peminjaman-wrapper .status-badge {
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
            text-align: center;
            background-color: #fff4e6;
            color: #f0ad4e;
            min-width: 90px;
        }

        .peminjaman-wrapper .action-icons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .peminjaman-wrapper .btn-action {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: 0.3s;
            font-size: 1rem;
            border: none;
            cursor: pointer;
        }

        .peminjaman-wrapper .btn-view {
            background-color: #f0f0f0;
            color: #666;
        }

        .peminjaman-wrapper .btn-return {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .peminjaman-wrapper .btn-return:hover {
            background-color: #2e7d32;
            color: white;
        }

        .peminjaman-wrapper .pagination {
            display: flex;
            justify-content: flex-end;
            margin-top: 25px;
            gap: 8px;
        }

        .peminjaman-wrapper .pagination button {
            width: 35px;
            height: 35px;
            border: 1px solid #ccc;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.85rem;
            transition: 0.3s;
        }

        .peminjaman-wrapper .pagination button.active-page {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Modal Global Styles (Tetap di root agar menutupi seluruh layar) */
        .custom-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 10000;
        }

        .custom-modal-overlay.active {
            display: flex;
        }

        .modal-confirm,
        .filter-modal {
            background: white;
            border-radius: 12px;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .modal-confirm {
            padding: 40px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            transform: scale(0.8);
        }

        .filter-modal {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 450px;
            transform: scale(0.9);
        }

        .custom-modal-overlay.active .modal-confirm,
        .custom-modal-overlay.active .filter-modal {
            transform: scale(1);
        }

        .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            border: 4px solid #5c6ac4;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse-blue 2s infinite;
        }

        .icon-box i {
            color: #5c6ac4;
            font-size: 40px;
        }

        @keyframes pulse-blue {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(92, 106, 196, 0.4);
            }

            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 15px rgba(92, 106, 196, 0);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(92, 106, 196, 0);
            }
        }

        .modal-confirm h4 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #5c6ac4;
        }

        .modal-confirm p {
            color: #666;
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .confirm-actions {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .btn-modal {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-cancel {
            background-color: transparent;
            color: #777;
            border: 2px solid #cccccc !important;
        }

        .btn-cancel:hover {
            background-color: #cccccc;
            color: white;
        }

        .btn-confirm {
            background-color: #5c6ac4;
            color: white;
            border: 2px solid #5c6ac4;
        }

        .btn-confirm:hover {
            background-color: #4b59b1;
            border-color: #4b59b1;
        }

        .filter-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            border-bottom: 1px solid #eceef3;
        }

        .filter-modal-header h3 {
            font-size: 1.2rem;
            color: #5c6ac4;
            font-weight: 700;
            margin: 0;
        }

        .filter-modal-close {
            font-size: 1.8rem;
            color: #8e99af;
            cursor: pointer;
        }

        .filter-modal-body {
            padding: 25px;
        }

        .filter-group {
            margin-bottom: 20px;
        }

        .filter-group label {
            display: block;
            font-size: 16px;
            font-weight: 600;
            color: #4854a0;
            margin-bottom: 12px;
        }

        .filter-input {
            width: 100%;
            padding: 12px 15px;
            border: 1.2px solid #e0e6ed;
            border-radius: 10px;
            font-size: 16px;
            outline: none;
            transition: 0.2s;
        }

        .filter-input:focus {
            border-color: #5c6ac4;
            box-shadow: 0 0 0 3px rgba(92, 106, 196, 0.1);
        }

        .filter-modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding: 20px 25px;
            border-top: 1px solid #eceef3;
        }

        .btn-filter-modal {
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            border: none;
            transition: 0.3s;
        }

        .btn-reset {
            background: #f0f0f0;
            color: #666;
        }

        .btn-apply {
            background: #5c6ac4;
            color: white;
        }
    </style>
@endpush

@section('content')
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

                <div class="pagination">
                    <button><i class="fas fa-chevron-left"></i></button>
                    <button class="active-page">1</button><button>2</button><button>3</button>
                    <button><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div id="returnModalOverlay" class="custom-modal-overlay">
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
    <script>
        // Logic Return Modal
        const modalReturn = document.getElementById('returnModalOverlay');
        const displayID = document.getElementById('displayID');

        function openReturnModal(id) {
            displayID.innerText = id;
            modalReturn.classList.add('active');
        }

        function closeReturnModal() {
            modalReturn.classList.remove('active');
        }

        document.getElementById('btnConfirmReturn').addEventListener('click', () => {
            console.log("Buku ID " + displayID.innerText + " dikembalikan");
            closeReturnModal();
        });

        // Logic Filter Modal
        const filterOverlay = document.getElementById('filterModalOverlay');
        const btnOpenFilter = document.getElementById('btnOpenFilter');
        const btnCloseFilter = document.getElementById('btnCloseFilter');
        const btnResetFilter = document.getElementById('btnResetFilter');
        const btnApplyFilter = document.getElementById('btnApplyFilter');
        const inputTglPinjam = document.getElementById('filterTglPinjam');
        const inputTglKembali = document.getElementById('filterTglKembali');

        btnApplyFilter.addEventListener('click', () => {
            const filterPinjam = inputTglPinjam.value;
            const filterKembali = inputTglKembali.value;
            const tableRows = document.querySelectorAll('#peminjamanTable tbody tr');

            tableRows.forEach(row => {
                const tglPinjamTeks = row.cells[3].textContent.trim();
                const tglKembaliTeks = row.cells[4].textContent.trim();

                const tglPinjamFormatted = formatDateToISO(tglPinjamTeks);
                const tglKembaliFormatted = formatDateToISO(tglKembaliTeks);

                let isMatch = true;
                if (filterPinjam && tglPinjamFormatted !== filterPinjam) isMatch = false;
                if (filterKembali && tglKembaliFormatted !== filterKembali) isMatch = false;

                row.style.display = isMatch ? "" : "none";
            });

            filterOverlay.classList.remove('active');
        });

        function formatDateToISO(dateStr) {
            const parts = dateStr.split('/');
            if (parts.length === 3) return `${parts[2]}-${parts[1]}-${parts[0]}`;
            return "";
        }

        btnResetFilter.addEventListener('click', () => {
            inputTglPinjam.value = '';
            inputTglKembali.value = '';
            document.querySelectorAll('#peminjamanTable tbody tr').forEach(row => {
                row.style.display = "";
            });
        });

        btnOpenFilter.addEventListener('click', () => filterOverlay.classList.add('active'));
        btnCloseFilter.addEventListener('click', () => filterOverlay.classList.remove('active'));

        // Tutup modal jika user klik di area luar modal
        window.onclick = (e) => {
            if (e.target == filterOverlay) filterOverlay.classList.remove('active');
            if (e.target == modalReturn) closeReturnModal();
        };
    </script>
@endpush