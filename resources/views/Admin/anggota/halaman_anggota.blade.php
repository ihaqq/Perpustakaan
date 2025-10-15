<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota - SIPERPUS</title>
    @vite('resources/css/admin/anggota/halaman_anggota.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
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
                    <li class="active">
                        <a href="#"><i class="fas fa-users"></i> <span>Anggota</span> <i class="fas fa-caret-down"></i></a>
                        <ul class="submenu" style="display: block;">
                            <li class="active"><a href="anggota.html">Daftar Anggota</a></li>
                            <li><a href="#">Tambah Anggota</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-book"></i> <span>Manajemen Buku</span> <i class="fas fa-caret-down"></i></a>
                        <ul class="submenu">
                            <li><a href="buku.html">Daftar Buku</a></li>
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
                    <h1>Daftar Anggota</h1>
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
    </div>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const navLinksWithSubmenu = document.querySelectorAll('.sidebar nav ul li a');
        const memberSearchInput = document.getElementById('memberSearch');

        const openFilterModalBtn = document.getElementById('openFilterModal');
        const closeFilterModalBtn = document.getElementById('closeFilterModal');
        const modalOverlay = document.getElementById('modalOverlay');
        const filterModal = document.getElementById('filterModal');

        const typeFilterOptionsDiv = document.getElementById('typeFilterOptions');
        const tingkatFilterOptionsDiv = document.getElementById('tingkatFilterOptions');
        const jurusanFilterOptionsDiv = document.getElementById('jurusanFilterOptions');
        const nomorKelasFilterOptionsDiv = document.getElementById('nomorKelasFilterOptions');

        const tingkatFilterGroup = document.getElementById('tingkatFilterGroup');
        const jurusanFilterGroup = document.getElementById('jurusanFilterGroup');
        const nomorKelasFilterGroup = document.getElementById('nomorKelasFilterGroup');

        const resetFiltersBtn = document.getElementById('resetFiltersBtn');
        const applyFiltersBtn = document.getElementById('applyFiltersBtn');

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

        // Dummy data yang diperbarui agar sesuai dengan kolom baru
        const members = [{
            nama: 'Dinda Permata',
            kelas: 'XII TKJ 1',
            username: 'dindaa',
            password: 'dinda123',
            role: 'User',
            tingkat: 'XII',
            jurusan: 'TKJ',
            sub_kelas: '1',
            type: 'Siswa',
            foto: 'https://placehold.co/30x30/png'
        }, {
            nama: 'Budi Santoso',
            kelas: 'XI RPL 2',
            username: 'budisanto',
            password: 'budi123',
            role: 'User',
            tingkat: 'XI',
            jurusan: 'RPL',
            sub_kelas: '2',
            type: 'Siswa',
            foto: 'https://placehold.co/30x30/png'
        }, {
            nama: 'Siti Rahayu',
            kelas: 'X TSM 3',
            username: 'sitirahayu',
            password: 'siti123',
            role: 'User',
            tingkat: 'X',
            jurusan: 'TSM',
            sub_kelas: '3',
            type: 'Siswa',
            foto: 'https://placehold.co/30x30/png'
        }, {
            nama: 'Admin Utama',
            kelas: '-',
            username: 'admin',
            password: 'admin',
            role: 'Admin',
            tingkat: '',
            jurusan: '',
            sub_kelas: '',
            type: 'Admin',
            foto: 'https://placehold.co/30x30/png'
        }];

        function populateMembersTable() {
            const memberTableBody = document.getElementById('memberTableBody');
            memberTableBody.innerHTML = '';
            members.forEach((member, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${index + 1}</td>
                <td><img src="${member.foto}" alt="Foto ${member.nama}" class="member-photo"></td>
                <td>${member.nama}</td>
                <td>${member.kelas}</td>
                <td>${member.username}</td>
                <td>${member.password}</td>
                <td>${member.role}</td>
                <td class="action-icons">
                    <a href="#" style="color: var(--primary-color); margin-right: 5px;"><i class="fas fa-edit"></i></a>
                    <a href="#" style="color: #e74c3c;"><i class="fas fa-trash-alt"></i></a>
                </td>
            `;
                memberTableBody.appendChild(row);
            });
        }

        function filterMembers() {
            const selectedType = typeFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;
            const selectedTingkat = tingkatFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;
            const selectedJurusan = jurusanFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;
            const selectedNomorKelas = nomorKelasFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;

            const searchTerm = memberSearchInput.value.toLowerCase();
            const rows = document.querySelectorAll('#memberTableBody tr');

            rows.forEach(row => {
                const rowName = row.cells[2].textContent.toLowerCase();
                const memberIndex = parseInt(row.cells[0].textContent) - 1;
                const memberData = members[memberIndex];

                const typeMatch = selectedType === '' || memberData.type === selectedType;
                const tingkatMatch = selectedTingkat === '' || memberData.tingkat === selectedTingkat;
                const jurusanMatch = selectedJurusan === '' || memberData.jurusan === selectedJurusan;
                const nomorKelasMatch = selectedNomorKelas === '' || memberData.sub_kelas === selectedNomorKelas;
                const searchMatch = rowName.includes(searchTerm);

                if (typeMatch && tingkatMatch && jurusanMatch && nomorKelasMatch && searchMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function updateFilterUI() {
            const selectedType = typeFilterOptionsDiv.querySelector('.filter-option-item.selected').dataset.filterValue;

            if (selectedType === 'Admin') {
                tingkatFilterGroup.classList.add('disabled');
                jurusanFilterGroup.classList.add('disabled');
                nomorKelasFilterGroup.classList.add('disabled');

                tingkatFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => {
                    opt.classList.remove('selected');
                    if (opt.dataset.filterValue === '') opt.classList.add('selected');
                });
                jurusanFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => {
                    opt.classList.remove('selected');
                    if (opt.dataset.filterValue === '') opt.classList.add('selected');
                });
                nomorKelasFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => {
                    opt.classList.remove('selected');
                    if (opt.dataset.filterValue === '') opt.classList.add('selected');
                });

            } else {
                tingkatFilterGroup.classList.remove('disabled');
                jurusanFilterGroup.classList.remove('disabled');
                nomorKelasFilterGroup.classList.remove('disabled');
            }
        }


        function resetFilters() {
            typeFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => {
                opt.classList.remove('selected');
                if (opt.dataset.filterValue === '') {
                    opt.classList.add('selected');
                }
            });

            tingkatFilterGroup.classList.remove('disabled');
            jurusanFilterGroup.classList.remove('disabled');
            nomorKelasFilterGroup.classList.remove('disabled');

            tingkatFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => {
                opt.classList.remove('selected');
                if (opt.dataset.filterValue === '') opt.classList.add('selected');
            });
            jurusanFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => {
                opt.classList.remove('selected');
                if (opt.dataset.filterValue === '') opt.classList.add('selected');
            });
            nomorKelasFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => {
                opt.classList.remove('selected');
                if (opt.dataset.filterValue === '') opt.classList.add('selected');
            });

            memberSearchInput.value = '';
            filterMembers();
        }

        openFilterModalBtn.addEventListener('click', () => {
            modalOverlay.classList.add('active');
        });

        closeFilterModalBtn.addEventListener('click', () => {
            modalOverlay.classList.remove('active');
        });

        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                modalOverlay.classList.remove('active');
            }
        });

        typeFilterOptionsDiv.addEventListener('click', (e) => {
            if (e.target.classList.contains('filter-option-item')) {
                typeFilterOptionsDiv.querySelectorAll('.filter-option-item').forEach(opt => opt.classList.remove('selected'));
                e.target.classList.add('selected');
                updateFilterUI();
            }
        });

        [tingkatFilterOptionsDiv, jurusanFilterOptionsDiv, nomorKelasFilterOptionsDiv].forEach(filterDiv => {
            filterDiv.addEventListener('click', (e) => {
                if (e.target.classList.contains('filter-option-item') && !filterDiv.parentElement.classList.contains('disabled')) {
                    filterDiv.querySelectorAll('.filter-option-item').forEach(opt => opt.classList.remove('selected'));
                    e.target.classList.add('selected');
                }
            });
        });

        resetFiltersBtn.addEventListener('click', resetFilters);
        applyFiltersBtn.addEventListener('click', () => {
            filterMembers();
            modalOverlay.classList.remove('active');
        });

        memberSearchInput.addEventListener('keyup', filterMembers);

        window.onload = () => {
            populateMembersTable();
            filterMembers();
        };
    </script>
</body>

</html>