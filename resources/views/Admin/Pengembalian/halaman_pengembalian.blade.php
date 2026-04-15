@extends('Admin/Layouts.dashboard')

@section('title', 'Peminjaman - SIPERPUS')

@push('styles')
    @vite('resources/css/admin/Pengembalian/pengembalian.css')
    @vite('resources/css/admin/sidebar/sidebar_tes.css')
@endpush

@section('content')
    <main class="main-content">
        <header class="navbar">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="header-left">
                <i id="sidebar-toggle" class="fas fa-bars"></i>
                <h1>Pengembalian</h1>
            </div>
            <div class="header-right">
                <i class="fas fa-bell notification-bell"></i>
                <div class="user-profile">
                    <i class="fas fa-user-circle"></i>
                </div>
            </div>
        </header>

        <main class="main-content">
            <div class="form-container">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-info-circle"></i>
                        <h3>Informasi Pengembalian</h3>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px">
                        <label>Nama Anggota:</label>
                        <input type="text" id="inputNama" placeholder="Cari nama anggota..." />
                    </div>
                    <div class="form-group">
                        <label>Tanggal Dikembalikan:</label>
                        <input type="date" id="inputTanggal" />
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-book"></i>
                        <h3>Buku Yang Dikembalikan</h3>
                    </div>
                    <div class="form-group"><label>Detail Buku:</label></div>
                    <div class="book-detail-box">
                        <div class="book-info">
                            <h4>Laskar Pelangi</h4>
                            <p>ID: BK-0001</p>
                        </div>
                        <span class="badge badge-success">TEPAT WAKTU</span>
                    </div>
                    <div style="
                            display: flex;
                            justify-content: space-between;
                            margin: 15px 0;
                            font-weight: 700;
                            color: var(--text-blue);
                            font-size: 0.9rem;
                          ">
                        <span>Total Denda:</span>
                        <span style="color: var(--danger)">Rp 0</span>
                    </div>
                    <button class="btn-simpan">SELESAIKAN PENGEMBALIAN</button>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Semua Pengembalian Buku</h3>
                </div>

                <div class="controls-row">
                    <div class="search-wrapper">
                        <i class="fas fa-search"></i>
                        <input type="text" id="returnSearch" placeholder="Cari Buku atau Nama..." />
                    </div>
                    <div class="filter-buttons">
                        <button class="btn-filter active">Semua Status</button>
                        <button class="btn-filter">Tepat Waktu</button>
                        <button class="btn-filter">Terlambat</button>
                    </div>
                </div>

                <div style="overflow-x: auto">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>ID Peminjaman</th>
                                <th>Nama Anggota</th>
                                <th>Batas Pengembalian</th>
                                <th>Tgl Dikembalikan</th>
                                <th style="text-align: center">Status</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="peminjamanTableBody"></tbody>
                    </table>
                </div>
            </div>
        </main>
        </div>
        </section>
    </main>



@endsection
@push('scripts')
    @vite('resources/js/admin/Pengembalian/pengembalian.js')
@endpush