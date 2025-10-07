<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master - Perpustakaan</title>
    @vite('resources/css/halaman_admin.css')
    <!-- <link rel="stylesheet" href="././css/halaman_admin.css"> -->

</head>

<body >
    <nav class="navbar">
        <div class="logo">
            <h1>Data Master</h1>
        </div>

        <ul class="menu">
            <!-- Dashboard -->
            <li class="menu-item">
                <a href="#" class="menu-link active">
                    <i>📊</i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            <!-- Anggota -->
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i>👥</i>
                    <span class="menu-text">Anggota</span>
                    <span class="arrow">›</span>
                </a>
                <ul class="submenu">
                    <li><a href="#" class="submenu-link">Daftar Anggota</a></li>
                    <li><a href="#" class="submenu-link">Tambah Anggota</a></li>
                </ul>
            </li>

            <!-- Manajemen Buku -->
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i>📚</i>
                    <span class="menu-text">Manajemen Buku</span>
                    <span class="arrow">›</span>
                </a>
                <ul class="submenu">
                    <li><a href="#" class="submenu-link">Daftar Buku</a></li>
                    <li><a href="#" class="submenu-link">Kategori</a></li>
                </ul>
            </li>

            <!-- Antrian Pre-Order -->
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i>⏱️</i>
                    <span class="menu-text">Antrian Pre-Order</span>
                    <span class="arrow">›</span>
                </a>
                <ul class="submenu">
                    <li><a href="#" class="submenu-link">Daftar Antrian</a></li>
                    <li><a href="#" class="submenu-link">Konfirmasi Ketersediaan</a></li>
                </ul>
            </li>

            <!-- Transaksi -->
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i>💳</i>
                    <span class="menu-text">Transaksi</span>
                    <span class="arrow">›</span>
                </a>
                <ul class="submenu">
                    <li><a href="#" class="submenu-link">Peminjaman</a></li>
                    <li><a href="#" class="submenu-link">Pengembalian</a></li>
                    <li><a href="#" class="submenu-link">Riwayat</a></li>
                </ul>
            </li>

            <!-- Laporan -->
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i>📈</i>
                    <span class="menu-text">Laporan</span>
                    <span class="arrow">›</span>
                </a>
                <ul class="submenu">
                    <li><a href="#" class="submenu-link">Statistik</a></li>
                    <li><a href="#" class="submenu-link">Buku Populer</a></li>
                </ul>
            </li>

            <!-- Pengaturan -->
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i>⚙️</i>
                    <span class="menu-text">Pengaturan</span>
                </a>
            </li>
        </ul>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuItems = document.querySelectorAll('.menu-item');

            menuItems.forEach(item => {
                const link = item.querySelector('.menu-link');
                const submenu = item.querySelector('.submenu');

                if (submenu) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();

                        // Close other open submenus
                        menuItems.forEach(otherItem => {
                            if (otherItem !== item) {
                                otherItem.classList.remove('active');
                                otherItem.querySelector('.submenu').classList.remove('active');
                            }
                        });

                        // Toggle current item
                        item.classList.toggle('active');
                        submenu.classList.toggle('active');
                    });
                }

                // Set active page on click
                link.addEventListener('click', function() {
                    if (!submenu) {
                        menuItems.forEach(i => {
                            i.querySelector('.menu-link').classList.remove('active');
                        });
                        link.classList.add('active');
                    }
                });
            });
        });
    </script>
</body>

</html>