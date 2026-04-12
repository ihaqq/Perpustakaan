@extends('Admin/Layouts.dashboard')

@section('title', 'Halaman Detail Riwayat Transaksi')

@push('styles')
    @vite('resources/css/admin/transaksi/riwayat_transaksi/detail_riwayat/detail_riwayat.css')
    @vite('resources/css/admin/sidebar/sidebar_tes.css')
@endpush

@section('content')
        <main class="main-content">
            <header class="navbar">
                <div class="header-left">
                    <i id="sidebar-toggle" class="fas fa-bars"></i>
                    <h1>Detail Transaksi</h1>
                </div>
                <div class="header-right">
                    <i class="fas fa-bell"></i>
                    <div class="user-profile">
                        <i class="fas fa-user-circle"></i>
                    </div>
                </div>
            </header>

            <section class="content">
                <div class="back-button-container">
                    <a href="{{ route('riwayat-transaksi') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Riwayat</a>
                </div>

                <div class="hero-card">
                    <h2>Transaksi #P002</h2>
                    <p>Detail lengkap peminjaman dan pengembalian buku.</p>
                    <span class="status-badge status-selesai">Selesai</span>
                </div>

                <div class="info-grid">
                    <div class="info-section">
                        <h4><i class="fas fa-info-circle"></i> Informasi Transaksi</h4>
                        <ul class="info-list">
                            <li class="info-item">
                                <i class="fas fa-id-card-alt icon"></i>
                                <span class="label">ID Transaksi</span>
                                <span class="value">P002</span>
                            </li>
                            <li class="info-item">
                                <i class="fas fa-calendar-alt icon"></i>
                                <span class="label">Tanggal Pinjam</span>
                                <span class="value">14/08/2025</span>
                            </li>
                            <li class="info-item">
                                <i class="fas fa-calendar-check icon"></i>
                                <span class="label">Tanggal Kembali</span>
                                <span class="value">14/08/2025</span>
                            </li>
                            <li class="info-item">
                                <i class="fas fa-book-reader icon"></i>
                                <span class="label">Kondisi Buku</span>
                                <span class="value">Baik</span>
                            </li>
                        </ul>
                    </div>

                    <div class="info-section">
                        <h4><i class="fas fa-user-circle"></i> Informasi Anggota</h4>
                        <ul class="info-list">
                            <li class="info-item">
                                <i class="fas fa-id-card icon"></i>
                                <span class="label">ID Anggota</span>
                                <span class="value">A003</span>
                            </li>
                            <li class="info-item">
                                <i class="fas fa-user icon"></i>
                                <span class="label">Nama Anggota</span>
                                <span class="value">Buril Santoso</span>
                            </li>
                            <li class="info-item">
                                <i class="fas fa-chalkboard-teacher icon icon"></i>
                                <span class="label">Kelas</span>
                                <span class="value">XII TKJ 2</span>
                            </li>
                            <li class="info-item">
                                <i class="fas fa-phone icon"></i>
                                <span class="label">Telepon</span>
                                <span class="value">0812-3486-7880</span>
                            </li>
                        </ul>
                    </div>

                    <div class="info-section">
                        <h4><i class="fas fa-book"></i> Informasi Buku</h4>
                        <ul class="info-list">
                            <li class="info-item">
                                <i class="fas fa-hashtag icon"></i>
                                <span class="label">Kode Buku</span>
                                <span class="value">BK005</span>
                            </li>
                            <li class="info-item">
                                <i class="fas fa-bookmark icon"></i>
                                <span class="label">Judul Buku</span>
                                <span class="value">Atomic Habits</span>
                            </li>
                            <li class="info-item">
                                <i class="fas fa-user-edit icon"></i>
                                <span class="label">Pengarang</span>
                                <span class="value">James Clear</span>
                            </li>
                            <li class="info-item">
                                <i class="fas fa-tags icon"></i>
                                <span class="label">Kategori</span>
                                <span class="value">Non-Fiksi</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </main>
@endsection
@push('scripts')
    @vite('resources/js/admin/transaksi/riwayat_transaksi/halaman_riwayat_transaksi.js')
@endpush
