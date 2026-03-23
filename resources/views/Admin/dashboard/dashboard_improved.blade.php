<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIPERPUS</title>
    <link rel="stylesheet" href="{{ asset('asset/css/admin/dashboard/dashboard_improved.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src='{{ asset('images/siperpus.png') }}' width="40" height="40" alt="SIPERPUS Logo">
                <h2>SIPERPUS</h2>
            </div>
            <nav>
                <ul>
                    <li class="active">
                        <a href="siperpus/dashboard.html">
                            <i class="fas fa-chart-line"></i> 
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-toggle">
                            <i class="fas fa-users"></i> 
                            <span>Anggota</span> 
                            <i class="fas fa-caret-down"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="halaman-daftar-anggota"><i class="fas fa-list"></i>Daftar Anggota</a></li>
                            <li><a href="#"><i class="fas fa-user-plus"></i>Tambah Anggota</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="menu-toggle">
                            <i class="fas fa-book"></i> 
                            <span>Manajemen Buku</span> 
                            <i class="fas fa-caret-down"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="siperpus/buku.html"><i class="fas fa-book-open"></i>Daftar Buku</a></li>
                            <li><a href="#"><i class="fas fa-tags"></i>Kategori</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="menu-toggle">
                            <i class="fas fa-clock"></i> 
                            <span>Antrian Pre-Order</span> 
                            <i class="fas fa-caret-down"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="antrian.html"><i class="fas fa-clipboard-list"></i>Daftar Antrian</a></li>
                            <li><a href="#"><i class="fas fa-check-circle"></i>Konfirmasi Ketersediaan</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="menu-toggle">
                            <i class="fas fa-exchange-alt"></i> 
                            <span>Transaksi</span> 
                            <i class="fas fa-caret-down"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="transaksi.html"><i class="fas fa-hand-holding"></i>Peminjaman</a></li>
                            <li><a href="#"><i class="fas fa-undo-alt"></i>Pengembalian</a></li>
                            <li><a href="#"><i class="fas fa-history"></i>Riwayat</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="menu-toggle">
                            <i class="fas fa-file-alt"></i> 
                            <span>Laporan</span> 
                            <i class="fas fa-caret-down"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="laporan.html"><i class="fas fa-chart-bar"></i>Statistik</a></li>
                            <li><a href="#"><i class="fas fa-star"></i>Buku Populer</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="settings">
                <a href="#">
                    <i class="fas fa-cog"></i> 
                    <span>Pengaturan</span>
                </a>
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
                    <i class="fas fa-bell notification-bell"></i>
                    <div class="user-profile">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </header>

            <!-- Statistics Cards -->
            <section class="content">
                <div class="stat-cards-container">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h2 id="member-count">123</h2>
                            <p>Anggota</p>
                            <a href="#" class="view-more">
                                Lihat Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-info">
                            <h2 id="book-count">1234</h2>
                            <p>Buku</p>
                            <a href="#" class="view-more">
                                Lihat Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-book-reader"></i>
                        </div>
                        <div class="stat-info">
                            <h2 id="loan-count">1234</h2>
                            <p>Peminjaman</p>
                            <a href="#" class="view-more">
                                Lihat Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-undo"></i>
                        </div>
                        <div class="stat-info">
                            <h2 id="return-count">1234</h2>
                            <p>Pengembalian</p>
                            <a href="#" class="view-more">
                                Lihat Selengkapnya <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Grid -->
                <div class="dashboard-grid">
                    <div class="card card-data-perpustakaan">
                        <div class="card-header">
                            <h3>Data Perpustakaan</h3>
                        </div>
                        <div class="card-body ">
                            <div class="library-info">
                                <div class="info-item-left">
                                    <strong>Nama Perpustakaan : </strong>
                                    <strong>Alamat : </strong>
                                    <strong>Tentang : </strong>
                                </div>
                                <div class="info-item-right">
                                    <p>SI PERPUS</p>
                                    <p>SMKN 9 MALANG</p>
                                    <p>PERPUSTAKAAN SEKOLAH</p>
                                </div>
                                <!-- <div class="info-item">
                                    <strong>Nama Perpustakaan</strong>
                                    <p>SMA NAWASENA</p>
                                </div>
                                <div class="info-item">
                                    <strong>Alamat</strong>
                                    <p>MALANG</p>
                                </div>
                                <div class="info-item">
                                    <strong>Tentang</strong>
                                    <p>Perpustakaan Sekolah</p>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="card card-statistik-buku">
                        <div class="card-header">
                            <h3>Statistik Buku</h3>
                        </div>
                        <div class="card-body row-flex">
                            <div class="chart-info">
                                <p><strong>Total Inventaris:</strong> <span id="total-inventory">1234</span></p>
                                <p><strong>Buku di pinjam:</strong> <span id="books-borrowed">500</span></p>
                                <p><strong>Buku di rak:</strong> <span id="books-available">734</span></p>
                            </div>
                            <div class="pie-chart">
                                <canvas id="bookChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="card card-anggota-baru">
                        <div class="card-header">
                            <h3>Anggota Baru</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-container">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Role</th>
                                        </tr>
                                    </thead>
                                    <tbody id="memberTableBody">
                                        <!-- Data will be populated by JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card card-buku-terbaru">
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
                                        <!-- Data will be populated by JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Enhanced JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Enhanced Dashboard JavaScript
        class Dashboard {
            constructor() {
                this.sidebar = document.querySelector(".sidebar");
                this.sidebarToggle = document.getElementById("sidebar-toggle");
                this.menuToggles = document.querySelectorAll(".menu-toggle");
                
                this.initializeEventListeners();
                this.initializeChart();
                this.populateData();
                this.animateCounters();
            }

            initializeEventListeners() {
                // Sidebar toggle
                this.sidebarToggle.addEventListener("click", () => {
                    this.sidebar.classList.toggle("collapsed");
                    this.savePreference("sidebarCollapsed", this.sidebar.classList.contains("collapsed"));
                });

                // Menu toggles
                this.menuToggles.forEach(toggle => {
                    toggle.addEventListener("click", (e) => {
                        e.preventDefault();
                        this.toggleSubmenu(toggle);
                    });
                });

                // Load saved preferences
                this.loadPreferences();

                // Add smooth scrolling to view more links
                document.querySelectorAll(".view-more").forEach(link => {
                    link.addEventListener("click", (e) => {
                        e.preventDefault();
                        this.animateClick(link);
                    });
                });
            }

            toggleSubmenu(toggle) {
                const submenu = toggle.nextElementSibling;
                const parentLi = toggle.parentElement;

                if (parentLi.classList.contains("active")) {
                    submenu.style.display = "none";
                    parentLi.classList.remove("active");
                } else {
                    // Close other submenus
                    document.querySelectorAll(".sidebar nav ul .submenu").forEach(otherSubmenu => {
                        otherSubmenu.style.display = "none";
                        otherSubmenu.parentElement.classList.remove("active");
                    });

                    // Open clicked submenu
                    submenu.style.display = "block";
                    parentLi.classList.add("active");
                }
            }

            initializeChart() {
                const ctx = document.getElementById("bookChart").getContext("2d");
                
                // Enhanced chart with better styling
                this.bookChart = new Chart(ctx, {
                    type: "pie",
                    data: {
                        labels: ["Buku di pinjam", "Buku di rak"],
                        datasets: [{
                            data: [500, 734],
                            backgroundColor: [
                                "#5c6ac4",
                                "#e9ecef"
                            ],
                            borderWidth: 0,
                            hoverOffset: 8,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: "bottom",
                                labels: {
                                    padding: 20,
                                    usePointStyle: false, // perintah lingkaran/persegi panjang
                                    font: {
                                        size: 12,
                                        weight: "500"
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: "rgba(0, 0, 0, 0.8)",
                                titleColor: "#fff",
                                bodyColor: "#fff",
                                borderColor: "#5c6ac4",
                                borderWidth: 1,
                                cornerRadius: 8,
                                callbacks: {
                                    label: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = ((context.parsed / total) * 100).toFixed(1);
                                        return `${context.label}: ${context.parsed} (${percentage}%)`;
                                    }
                                }
                            }
                        },
                        animation: {
                            animateRotate: true,
                            duration: 2000
                        }
                    }
                });
            }

            populateData() {
                // Enhanced sample data
                const members = [
                    { nama: "Dinda Permata Sari", kelas: "XII IPA 1", role: "ADMIN" },
                    { nama: "Budi Santoso", kelas: "XI IPS 2", role: "SISWA" },
                    { nama: "Siti Rahayu", kelas: "X MIPA 3", role: "PETUGAS" },
                    { nama: "XIHUY", kelas: "XI MIPA 3", role: "SISWA" },
                    // { nama: "Siti Rahayu", kelas: "X MIPA 3", tanggal: "2024-04-25" },
                ];

                const books = [
                    { judul: "Laskar Pelangi", pengarang: "Andrea Hirata", stok: 10 },
                    { judul: "Filosofi Teras", pengarang: "Henry Manampiring", stok: 5 },
                    { judul: "Atomic Habits", pengarang: "James Clear", stok: 15 }
                ];

                this.populateTable("memberTableBody", members, ["nama", "kelas", "role"]);
                this.populateTable("bookTableBody", books, ["judul", "pengarang", "stok"]);
            }

            populateTable(tableId, data, columns) {
                const tableBody = document.getElementById(tableId);
                tableBody.innerHTML = "";

                data.forEach((item, index) => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${index + 1}</td>
                        ${columns.map(col => `<td>${item[col]}</td>`).join("")}
                    `;
                    
                    // Add stagger animation
                    row.style.opacity = "0";
                    row.style.transform = "translateY(20px)";
                    tableBody.appendChild(row);
                    
                    setTimeout(() => {
                        row.style.transition = "all 0.5s ease";
                        row.style.opacity = "1";
                        row.style.transform = "translateY(0)";
                    }, index * 100);
                });
            }

            animateCounters() {
                const counters = [
                    { id: "member-count", target: 123 },
                    { id: "book-count", target: 1234 },
                    { id: "loan-count", target: 1234 },
                    { id: "return-count", target: 1234 },
                    { id: "total-inventory", target: 1234 },
                    { id: "books-borrowed", target: 500 },
                    { id: "books-available", target: 734 }
                ];

                counters.forEach(counter => {
                    this.animateCounter(counter.id, counter.target);
                });
            }

            animateCounter(elementId, target) {
                const element = document.getElementById(elementId);
                if (!element) return;

                let current = 0;
                const increment = target / 100;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        element.textContent = target;
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(current);
                    }
                }, 20);
            }

            animateClick(element) {
                element.style.transform = "scale(0.95)";
                setTimeout(() => {
                    element.style.transform = "scale(1)";
                }, 150);
            }

            savePreference(key, value) {
                localStorage.setItem(`dashboard_${key}`, JSON.stringify(value));
            }

            loadPreferences() {
                const sidebarCollapsed = JSON.parse(localStorage.getItem('dashboard_sidebarCollapsed'));
                if (sidebarCollapsed) {
                    this.sidebar.classList.add('collapsed');
                }
            }

            // Method to update real-time data (can be called from external sources)
            updateStats(newStats) {
                Object.keys(newStats).forEach(key => {
                    const element = document.getElementById(key);
                    if (element) {
                        this.animateCounter(key, newStats[key]);
                    }
                });

                // Update chart if book stats changed
                if (newStats['books-borrowed'] || newStats['books-available']) {
                    this.bookChart.data.datasets[0].data = [
                        newStats['books-borrowed'] || 500,
                        newStats['books-available'] || 734
                    ];
                    this.bookChart.update();
                }
            }
        }

        // Initialize dashboard when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            window.dashboard = new Dashboard();
        });

        // Add some interactive features
        document.addEventListener('DOMContentLoaded', () => {
            // Add ripple effect to cards
            document.querySelectorAll(".stat-card, .card").forEach(card => {
                card.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
    </script>
</body>

</html>

