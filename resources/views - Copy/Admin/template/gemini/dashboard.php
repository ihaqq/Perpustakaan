
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIPERPUS</title>
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
        /* Sidebar */
        
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            padding: 20px;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            box-shadow: var(--box-shadow);
            transition: width 0.3s ease, padding 0.3s ease;
            overflow-x: hidden;
        }
        
        .sidebar.collapsed {
            width: 80px;
        }
        
        .sidebar .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 40px;
            padding-left: 10px;
            transition: opacity 0.3s ease;
        }
        
        .sidebar.collapsed .logo h2 {
            opacity: 0;
            width: 0;
        }
        
        .sidebar .logo img {
            width: 40px;
        }
        
        .sidebar h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            white-space: nowrap;
        }
        
        .sidebar nav {
            flex-grow: 1;
        }
        
        .sidebar nav ul {
            list-style: none;
        }
        
        .sidebar nav ul li {
            margin: 8px 0;
        }
        
        .sidebar nav ul li a {
            color: var(--sidebar-text);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 12px 10px;
            border-radius: 8px;
            transition: background-color 0.3s, padding-left 0.3s;
        }
        
        .sidebar nav ul li a:hover,
        .sidebar nav ul li.active>a {
            background-color: var(--sidebar-active-bg);
            padding-left: 15px;
            color: var(--primary-color);
        }
        
        .sidebar.collapsed nav ul li a:hover,
        .sidebar.collapsed nav ul li.active>a {
            padding-left: 10px;
        }
        
        .sidebar nav ul li i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }
        
        .sidebar nav ul li span {
            transition: opacity 0.3s ease;
        }
        
        .sidebar.collapsed nav ul li span {
            opacity: 0;
            display: none;
        }
        
        .sidebar nav ul li a .fa-caret-down {
            margin-left: auto;
            transition: transform 0.3s;
        }
        
        .sidebar.collapsed nav ul li a .fa-caret-down {
            display: none;
        }
        
        .sidebar nav ul li.active>a .fa-caret-down {
            transform: rotate(-90deg);
        }
        
        .sidebar .submenu {
            list-style: none;
            padding-left: 45px;
            margin-top: 5px;
            display: none;
        }
        
        .sidebar .submenu a {
            padding: 8px 10px;
            font-size: 0.9rem;
            background-color: transparent;
            color: #555;
        }
        
        .sidebar.collapsed .submenu {
            display: none !important;
        }
        
        .sidebar .settings {
            margin-top: auto;
            border-top: 1px solid #e0e0e0;
            padding-top: 10px;
        }
        
        .sidebar .settings a {
            display: block;
            color: var(--sidebar-text);
            text-decoration: none;
            padding: 12px 10px;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        
        .sidebar.collapsed .settings a {
            text-align: center;
        }
        
        .sidebar.collapsed .settings a span {
            display: none;
        }
        
        .sidebar .settings a:hover {
            background-color: var(--sidebar-active-bg);
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
        /* Stat Cards */
        
        .stat-cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .stat-card {
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 25px;
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            border: 1px solid #e0e0e0;
            transition: transform 0.3s ease, border-color 0.3s;
            gap: 15px;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
        }
        
        .stat-card .stat-icon {
            background-color: transparent;
            color: var(--primary-color);
            border-radius: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
        }
        
        .stat-info {
            text-align: left;
            flex-grow: 1;
        }
        
        .stat-info h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stat-info p {
            color: #777;
            font-size: 1rem;
        }
        
        .stat-info a {
            display: inline-flex;
            align-items: center;
            color: var(--primary-color);
            text-decoration: none;
            margin-top: 10px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .stat-info a i {
            margin-left: 5px;
            transition: transform 0.3s;
        }
        
        .stat-info a:hover i {
            transform: translateX(5px);
        }
        /* Dashboard Grid */
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
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
        
        .card-body.row-flex {
            display: flex;
            align-items: center;
            gap: 30px;
        }
        
        .chart-info {
            flex: 1;
        }
        
        .chart-info p {
            font-size: 1rem;
            margin-bottom: 10px;
        }
        
        .pie-chart {
            flex: 1;
            max-width: 250px;
            max-height: 250px;
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
        }
        
        th,
        td {
            text-align: left;
            padding: 8px;
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
    </style>
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src="foto/siperpus.png" alt="SIPERPUS" />
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