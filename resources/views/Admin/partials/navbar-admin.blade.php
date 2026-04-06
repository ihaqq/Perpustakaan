<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>
            <aside class="sidebar">
            <div class="logo">
                <img src='{{ asset('images/logoPerpus/siperpus.png') }}' width="40" height="40" alt="SIPERPUS Logo">
                <h2>SIPERPUS</h2>
            </div>
            <nav>
                <ul>
                    <li class="{{ request()->routeIs('dashboard') ? 'active' : ''}}">
                        <a href="{{route('dashboard')}}">
                            <i class="fas fa-chart-line"></i> 
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('daftar-anggota') || request()->routeIs('tambah-anggota') ? 'active' : ''}}">
                        <a href="#" class="menu-toggle">
                            <i class="fas fa-users"></i> 
                            <span>Anggota</span> 
                            <i class="fas fa-caret-down"></i>
                        </a>
                        <ul class="submenu" style="{{ request()->routeIs('daftar-anggota') || request()->routeIs('tambah-anggota') ? 'display: block;' : ''}}">
                            <li class="{{ request()->routeIs('daftar-anggota') ? 'active' : ''}}"><a href="{{route('daftar-anggota')}}"><i class="fas fa-list"></i>Daftar Anggota</a></li>
                            <li class="{{ request()->routeIs('tambah-anggota') ? 'active' : ''}}"><a href="{{route('konfirmasi-pengguna')}}"><i class="fas fa-user-plus"></i>Konfirmasi Pengguna</a></li>
                        </ul>
                    </li>
                    <li class="{{ request()->routeIs('halaman-buku') || request()->routeIs('kategori-buku') ? 'active' : ''}}">
                        <a href="#" class="menu-toggle">
                            <i class="fas fa-book"></i> 
                            <span>Manajemen Buku</span> 
                            <i class="fas fa-caret-down"></i>
                        </a>
                        <ul class="submenu" style="{{ request()->routeIs('halaman-buku') || request()->routeIs('kategori-buku') ? 'display: block;' : ''}}">
                            <li class="{{ request()->routeIs('halaman-buku') ? 'active' : ''}}"><a href="{{ route('daftar-buku') }}"><i class="fas fa-book-open"></i>Daftar Buku</a></li>
                            <li class="{{ request()->routeIs('kategori-buku') ? 'active' : ''}}"><a href="{{ route('daftar-genre') }}"><i class="fas fa-tags"></i>Daftar Genre</a></li>
                        </ul>
                    </li>
                    <li class="{{ request()->routeIs('daftar-antrian') || request()->routeIs('konfirmasi-ketersediaan') ? 'active' : ''}}">
                        <a href="#" class="menu-toggle">
                            <i class="fas fa-clock"></i> 
                            <span>Antrian Pre-Order</span> 
                            <i class="fas fa-caret-down"></i>
                        </a>
                        <ul class="submenu" style="{{ request()->routeIs('daftar-antrian') || request()->routeIs('konfirmasi-ketersediaan') ? 'display: block;' : ''}}">
                            <li class="{{ request()->routeIs('daftar-antrian') ? 'active' : ''}}"><a href="antrian.html"><i class="fas fa-clipboard-list"></i>Daftar Antrian</a></li>
                            <li class="{{ request()->routeIs('konfirmasi-ketersediaan') ? 'active' : ''}}"><a href="#"><i class="fas fa-check-circle"></i>Konfirmasi Ketersediaan</a></li>
                        </ul>
                    </li>
                    <li class="{{ request()->routeIs('peminjaman') || request()->routeIs('pengembalian') || request()->routeIs('riwayat-transaksi') ? 'active' : ''}}">
                        <a href="#" class="menu-toggle">
                            <i class="fas fa-exchange-alt"></i> 
                            <span>Transaksi</span> 
                            <i class="fas fa-caret-down"></i>
                        </a>
                        <ul class="submenu" style="{{ request()->routeIs('peminjaman') || request()->routeIs('pengembalian') || request()->routeIs('riwayat-transaksi') || request()->routeIs('detail-transaksi') ? 'display: block;' : ''}}">
                            <li class="{{ request()->routeIs('peminjaman') ? 'active' : ''}}"><a href="transaksi.html"><i class="fas fa-hand-holding"></i>Peminjaman</a></li>
                            <li class="{{ request()->routeIs('pengembalian') ? 'active' : ''}}"><a href="#"><i class="fas fa-undo-alt"></i>Pengembalian</a></li>
                            <li class="{{ request()->routeIs('riwayat-transaksi') ? 'active' : ''}}"><a href="{{route('riwayat-transaksi')}}"><i class="fas fa-history"></i>Riwayat</a></li>
                            <li class="{{ request()->routeIs('detail-transaksi') ? 'active' : ''}}"><a href="{{route('detail-transaksi')}}"><i class="fas fa-info-circle"></i>Detail Transaksi</a></li>
                        </ul>
                    </li>
                    <li class="{{ request()->routeIs('statistik-laporan') || request()->routeIs('buku-populer') ? 'active' : ''}}">
                        <a href="#" class="menu-toggle">
                            <i class="fas fa-file-alt"></i> 
                            <span>Laporan</span> 
                            <i class="fas fa-caret-down"></i>
                        </a>
                        <ul class="submenu" style="{{ request()->routeIs('statistik-laporan') || request()->routeIs('buku-populer') ? 'display: block;' : ''}}">
                            <li class="{{ request()->routeIs('statistik-laporan') ? 'active' : ''}}"><a href="laporan.html"><i class="fas fa-chart-bar"></i>Statistik</a></li>
                            <li class="{{ request()->routeIs('buku-populer') ? 'active' : ''}}"><a href="#"><i class="fas fa-star"></i>Buku Populer</a></li>
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


