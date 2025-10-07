
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIPERPUS</title>
        @vite('resources/css/gemini/dashboard.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <aside class="sidebar" >
            <div class="logo">
                <img src='{{ asset('images/siperpus.png') }}' width="40" height="45">
                <h2>SIPERPUS</h2>
            </div>
            <nav>
                <ul>
                    <li class="active"><a href="siperpus/dashboard.html"><i class="fas fa-chart-line"></i> <span>Dashboard</span></a></li>
                    <li>
                        <a href="#"><i class="fas fa-users"></i> <span>Anggota</span> <i class="fas fa-caret-down"></i></a>
                        <ul class="submenu">
                            <li><a href="siperpus/anggota.html">Daftar Anggota</a></li>
                            <li><a href="#">Tambah Anggota</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-book"></i> <span>Manajemen Buku</span> <i class="fas fa-caret-down"></i></a>
                        <ul class="submenu">
                            <li><a href="siperpus/buku.html">Daftar Buku</a></li>
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

        <!-- Main Content -->
        <main class="main-content">
            <header class="navbar">
                <div class="header-left">
                    <i id="sidebar-toggle" class="fas fa-bars"></i>
                    <h1>Dashboard</h1>
                </div>
                <div class="header-right">
                    <i class="fas fa-bell"></i>
                    <div class="user-profile">
                        <i class="fas fa-user-circle"></i>
                        <span>Admin</span>
                    </div>
                </div>
            </header>

            <!-- Card -->
            <section class="content">
                <div class="stat-cards-container">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-users fa-2x" style="color: #0984e3;"></i></div>
                        <div class="stat-info">
                            <h2>123</h2>
                            <p>Anggota</p>
                            <a href="#">Lihat Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-book fa-2x" style="color: #6c5ce7;"></i></div>
                        <div class="stat-info">
                            <h2>1234</h2>
                            <p>Buku</p>
                            <a href="#">Lihat Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-book-reader fa-2x" style="color: #feca57;"></i></div>
                        <div class="stat-info">
                            <h2>1234</h2>
                            <p>Peminjaman</p>
                            <a href="#">Lihat Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-undo fa-2x" style="color: #2ed573;"></i></div>
                        <div class="stat-info">
                            <h2>1234</h2>
                            <p>Pengembalian</p>
                            <a href="#">Lihat Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="dashboard-grid">
                    <div class="card">
                        <div class="card-header">
                            <h3>Data Perpustakaan</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Nama Perpustakaan</strong></p>
                            <p>SMK NEGERI 9 MALANG</p>
                            <br>
                            <p><strong>Alamat</strong></p>
                            <p>MALANG</p>
                            <br>
                            <p><strong>Tentang</strong></p>
                            <p>Perpustakaan Sekolah</p>
                        </div>
                    </div>
                    <div class="card card-md">
                        <div class="card-header">
                            <h3>Statistik Buku</h3>
                        </div>
                        <div class="card-body row-flex">
                            <div class="chart-info">
                                <p>Total Inventaris: 1234</p>
                                <p>Buku di pinjam: 500</p>
                                <p>Buku di rak: 734</p>
                            </div>
                            <div class="pie-chart">
                                <canvas id="bookChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3>Buku Terbaru</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul Buku</th>
                                            <th>Pengarang</th>
                                            <th>Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bookTableBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3>Anggota Terbaru</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Tanggal Gabung</th>
                                        </tr>
                                    </thead>
                                    <tbody id="memberTableBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const navLinksWithSubmenu = document.querySelectorAll('.sidebar nav ul li a');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });

        const ctx = document.getElementById('bookChart').getContext('2d');
        const bookChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Buku di pinjam', 'Buku di rak'],
                datasets: [{
                    data: [500, 734],
                    backgroundColor: [
                        '#5c6ac4',
                        '#dfe6e9'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += context.parsed;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Submenu Toggle
        navLinksWithSubmenu.forEach(link => {
            link.addEventListener('click', (e) => {
                const submenu = link.nextElementSibling;
                const parentLi = link.parentElement;

                if (submenu) {
                    e.preventDefault();

                    // Toggle submenu display
                    if (parentLi.classList.contains('active')) {
                        submenu.style.display = 'none';
                        parentLi.classList.remove('active');
                    } else {
                        // Collapse any other open submenus
                        document.querySelectorAll('.sidebar nav ul .submenu').forEach(otherSubmenu => {
                            otherSubmenu.style.display = 'none';
                            otherSubmenu.parentElement.classList.remove('active');
                        });

                        // Open the clicked submenu
                        submenu.style.display = 'block';
                        parentLi.classList.add('active');
                    }
                }
            });
        });

        // Dummy Data for tables
        const members = [{
            nama: 'Dinda Permata',
            kelas: 'XII TKJ 1',
            tanggal: '2024-05-01'
        }, {
            nama: 'Budi Santoso',
            kelas: 'XI RPL 2',
            tanggal: '2024-04-28'
        }, {
            nama: 'Siti Rahayu',
            kelas: 'X AK 3',
            tanggal: '2024-04-25'
        }, ];

        const books = [{
            judul: 'Laskar Pelangi',
            pengarang: 'Andrea Hirata',
            stok: 10
        }, {
            judul: 'Filosofi Teras',
            pengarang: 'Henry Manampiring',
            stok: 5
        }, {
            judul: 'Atomic Habits',
            pengarang: 'James Clear',
            stok: 15
        }, ];

        // Function to populate tables
        function populateTables() {
            const memberTableBody = document.getElementById('memberTableBody');
            const bookTableBody = document.getElementById('bookTableBody');

            members.forEach((member, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${index + 1}</td>
                <td>${member.nama}</td>
                <td>${member.kelas}</td>
                <td>${member.tanggal}</td>
            `;
                memberTableBody.appendChild(row);
            });

            books.forEach((book, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                <td>${index + 1}</td>
                <td>${book.judul}</td>
                <td>${book.pengarang}</td>
                <td>${book.stok}</td>
            `;
                bookTableBody.appendChild(row);
            });
        }

        // Call the function to populate tables when the page loads
        window.onload = populateTables;
    </script>
</body>

</html>