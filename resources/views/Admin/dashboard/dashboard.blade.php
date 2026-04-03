@extends('Admin/Layouts.dashboard')

@section('title', 'Dashboard Admin')

@push('styles')
    @vite('resources/css/admin/dashboard/dashboard_tanpa_sidebar.css')
    @vite('resources/css/admin/sidebar/sidebar_tes.css')
@endpush

@section('content')
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
@endsection
@push('scripts')
    @vite('resources/js/admin/dashboard/dashboard_copy.js')
@endpush
