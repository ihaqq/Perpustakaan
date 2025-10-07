<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
            <aside class="sidebar">
            <div class="logo">
                <img src='{{ asset('images/siperpus.png') }}' width="40" height="40" alt="SIPERPUS Logo">
                <h2>SIPERPUS</h2>
            </div>
            <nav>
                <ul>
                    <li class="{{  request()->routeIs('dashboard') ? 'active' : ''}}">
                        <a href="{{route('dashboard')}}">
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
                        <ul class="submenu" >
                            <li><a href="{{route('daftar-anggota')}}"><i class="fas fa-list"></i>Daftar Anggota</a></li>
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
                            <li><a href="{{ route('halaman-buku') }}"><i class="fas fa-book-open"></i>Daftar Buku</a></li>
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
</body>
</html>

