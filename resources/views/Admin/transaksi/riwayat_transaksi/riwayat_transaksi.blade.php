@extends('Admin/Layouts.dashboard')

@section('title', 'Halaman Riwayat')

@push('styles')
    @vite('resources/css/admin/transaksi/riwayat_transaksi/halaman_riwayat_transaksi.css')
    @vite('resources/css/admin/sidebar/sidebar_tes.css')
@endpush

@section('content')
        <main class="main-content">
            <header class="navbar">
                <div class="header-left">
                    <i id="sidebar-toggle" class="fas fa-bars"></i>
                    <h1>Riwayat Transaksi</h1>
                </div>
                <div class="header-right">
                    <i class="fas fa-bell "></i>
                    <div class="user-profile">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </header>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <h3>Daftar Riwayat</h3>
                    </div>
                    <div class="card-body">
                        <div class="filter-section">
                            <input type="text" id="searchInput" placeholder="Cari ID, Anggota, atau Buku...">
                            <div class="filter-buttons">
                                <button class="filter-button active" data-status-filter="Semua Status">Semua Status</button>
                                <button class="filter-button" data-status-filter="Dipinjam">Dipinjam</button>
                                <button class="filter-button" data-status-filter="Selesai">Selesai</button>
                                <button class="filter-button" data-status-filter="Terlambat">Terlambat</button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table id="riwayatTable">
                                <thead>
                                    <tr>
                                        <th>ID Transaksi</th>
                                        <th>Anggota</th>
                                        <th>Buku</th>
                                        <th>Tanggal Pinjam</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-status="Dipinjam">
                                        <td>P001</td>
                                        <td>Dinda Permata</td>
                                        <td>Laskar Pelangi</td>
                                        <td>14/08/2025</td>
                                        <td>-</td>
                                        <td><span class="status-badge status-dipinjam">Dipinjam</span></td>
                                        <td><a href="{{ route('detail-transaksi') }}" class="table-action-link">Lihat Detail <i class="fas fa-arrow-right"></i></a></td>
                                    </tr>
                                    <tr data-status="Selesai">
                                        <td>P002</td>
                                        <td>Budi Santoso</td>
                                        <td>Filosofi Teras</td>
                                        <td>12/08/2025</td>
                                        <td>19/08/2025</td>
                                        <td><span class="status-badge status-selesai">Selesai</span></td>
                                        <td><a href="{{ route('detail-transaksi') }}" class="table-action-link">Lihat Detail <i class="fas fa-arrow-right"></i></a></td>
                                    </tr>
                                    <tr data-status="Terlambat">
                                        <td>K003</td>
                                        <td>Siti Rahayu</td>
                                        <td>Atomic Habits</td>
                                        <td>01/08/2025</td>
                                        <td>08/08/2025</td>
                                        <td><span class="status-badge status-terlambat">Terlambat</span></td>
                                        <td><a href="{{ route('detail-transaksi') }}" class="table-action-link">Lihat Detail <i class="fas fa-arrow-right"></i></a></td>
                                    </tr>
                                    <tr data-status="Dipinjam">
                                        <td>P004</td>
                                        <td>Joko Susilo</td>
                                        <td>Sebuah Seni Untuk Bersikap Bodo Amat</td>
                                        <td>15/08/2025</td>
                                        <td>-</td>
                                        <td><span class="status-badge status-dipinjam">Dipinjam</span></td>
                                        <td><a href="{{ route('detail-transaksi') }}" class="table-action-link">Lihat Detail <i class="fas fa-arrow-right"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </main>
@endsection
@push('scripts')
    @vite('resources/js/admin/transaksi/riwayat_transaksi/halaman_riwayat_transaksi.js')
@endpush
