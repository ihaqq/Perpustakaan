@extends('Admin/Layouts.app')

@section('title', 'SIPERPUS - Sistem Booking Buku Sekolah')

@push('styles')
    @vite('resources/css/LandingPage/landing_page.css')
@endpush

@section('content')

    <body>

        <div id="loader">
            <div class="spinner"></div>
        </div>

        <nav id="mainNav">
            <a href="#" class="logo">
                <i class="fas fa-book-bookmark"></i> SIPERPUS
            </a>
            <ul class="nav-links">
                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#layanan">Cara Kerja</a></li>
                <li><a href="#koleksi">Cek Buku</a></li>
                <li><a href="#faq">Bantuan</a></li>
            </ul>
            <div class="nav-actions">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            </div>
        </nav>

        <section class="hero" id="beranda">
            <div class="hero-content" data-aos="fade-right" data-aos-duration="1200">
                <span class="hero-tag">✨ Sistem Booking Buku Perpustakaan</span>
                <h1>Cari Bukunya, <span>Booking dari Kelas</span></h1>
                <p>Solusi cerdas literasi warga sekolah. Cek ketersediaan koleksi fisik secara real-time dan lakukan
                    Pre-Order (PO) tanpa harus antre di perpustakaan.</p>
                <div class="hero-btns">
                    <a href="#" class="btn btn-primary" style="padding: 18px 40px; font-size: 1.1rem;">Cari Buku
                        Sekarang</a>
                    <a href="#"
                        style="margin-left: 20px; color: var(--text-dark); text-decoration: none; font-weight: 700;">
                        <i class="fas fa-circle-info"
                            style="color: var(--primary); font-size: 1.5rem; vertical-align: middle; margin-right: 8px;"></i>
                        Panduan PO
                    </a>
                </div>
            </div>
            <div class="hero-img-container" data-aos="zoom-out" data-aos-duration="1500">
                <img src="https://images.unsplash.com/photo-1568667256549-094345857637?auto=format&fit=crop&q=80&w=1000"
                    alt="SIPERPUS Library">
            </div>
        </section>

        <section class="stats-section">
            <div class="stats-grid" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-card">
                    <h2 class="counter" data-target="15000">0</h2>
                    <p>Total Koleksi Buku</p>
                </div>
                <div class="stat-card">
                    <h2 class="counter" data-target="8500">0</h2>
                    <p>Siswa Terdaftar</p>
                </div>
                <div class="stat-card">
                    <h2 class="counter" data-target="450">0</h2>
                    <p>Booking Hari Ini</p>
                </div>
                <div class="stat-card">
                    <h2 class="counter" data-target="100">0</h2>
                    <p>Khusus Warga Sekolah %</p>
                </div>
            </div>
        </section>

        <section class="features" id="layanan">
            <div class="section-header" data-aos="fade-up">
                <span class="hero-tag">Cara Kerja</span>
                <h2>Lebih Efisien dengan Sistem PO</h2>
                <p>Kami mempermudah proses peminjaman buku fisik agar kamu punya lebih banyak waktu untuk belajar.</p>
            </div>
            <div class="feature-grid">
                <div class="feature-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon-box"><i class="fas fa-magnifying-glass"></i></div>
                    <h3>Cari & Booking</h3>
                    <p>Cari judul buku yang kamu inginkan, pilih opsi Pre-Order (PO) langsung dari dashboard siswa.</p>
                </div>
                <div class="feature-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon-box"><i class="fas fa-list-check"></i></div>
                    <h3>Pantau Antrian</h3>
                    <p>Lihat posisi antrianmu secara transparan. Kamu akan tahu kapan buku siap untuk diambil.</p>
                </div>
                <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon-box"><i class="fas fa-hand-holding"></i></div>
                    <h3>Ambil di Perpus</h3>
                    <p>Tunjukkan kode booking ke petugas perpustakaan dan bawa pulang buku favoritmu tanpa ribet.</p>
                </div>
            </div>
        </section>

        <section class="collections" id="koleksi">
            <div class="section-header" data-aos="fade-up">
                <span class="hero-tag">Katalog Buku</span>
                <h2>Cek Stok Koleksi Rak</h2>
                <p>Berikut adalah beberapa buku populer yang bisa kamu pesan sekarang. Pastikan statusnya "Tersedia".</p>
            </div>

            <div class="collection-tabs" data-aos="fade-up">
                <button class="tab-btn active" onclick="filterBooks('populer')">Buku Populer</button>
                <button class="tab-btn" onclick="filterBooks('terbaru')">Koleksi Terbaru</button>
            </div>

            <div class="book-grid" id="bookGrid" data-aos="fade-up">
                <div class="book-card populer">
                    <span class="book-badge">Tersedia</span>
                    <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=400" class="book-img">
                    <div class="book-info">
                        <h4>Filosofi Teras</h4>
                        <p>Rak A-12 (Non-Fiksi)</p>
                        <div class="book-meta">
                            <a href="#" class="btn btn-primary"
                                style="padding: 8px 20px; font-size: 0.8rem; width: 100%; text-align: center;">Booking
                                Sekarang</a>
                        </div>
                    </div>
                </div>

                <div class="book-card populer">
                    <span class="book-badge booked">Dipinjam</span>
                    <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?q=80&w=400" class="book-img">
                    <div class="book-info">
                        <h4>The Psychology of Money</h4>
                        <p>Rak B-05 (Ekonomi)</p>
                        <div class="book-meta">
                            <a href="#" class="btn"
                                style="padding: 8px 20px; font-size: 0.8rem; width: 100%; text-align: center; background: #e2e8f0; color: #64748b; cursor: not-allowed;">Masuk
                                Antrian</a>
                        </div>
                    </div>
                </div>

                <div class="book-card populer">
                    <span class="book-badge">Tersedia</span>
                    <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?q=80&w=400" class="book-img">
                    <div class="book-info">
                        <h4>Atomic Habits</h4>
                        <p>Rak A-02 (Self Dev)</p>
                        <div class="book-meta">
                            <a href="#" class="btn btn-primary"
                                style="padding: 8px 20px; font-size: 0.8rem; width: 100%; text-align: center;">Booking
                                Sekarang</a>
                        </div>
                    </div>
                </div>

                <div class="book-card populer">
                    <span class="book-badge">Tersedia</span>
                    <img src="https://images.unsplash.com/photo-1543004218-ee1411043080?q=80&w=400" class="book-img">
                    <div class="book-info">
                        <h4>Bicara Itu Ada Seninya</h4>
                        <p>Rak C-01 (Komunikasi)</p>
                        <div class="book-meta">
                            <a href="#" class="btn btn-primary"
                                style="padding: 8px 20px; font-size: 0.8rem; width: 100%; text-align: center;">Booking
                                Sekarang</a>
                        </div>
                    </div>
                </div>

                <div class="book-card populer">
                    <span class="book-badge booked">Dipinjam</span>
                    <img src="https://images.unsplash.com/photo-1532012197367-630972827ff5?q=80&w=400" class="book-img">
                    <div class="book-info">
                        <h4>Rich Dad Poor Dad</h4>
                        <p>Rak B-07 (Finansial)</p>
                        <div class="book-meta">
                            <a href="#" class="btn"
                                style="padding: 8px 20px; font-size: 0.8rem; width: 100%; text-align: center; background: #e2e8f0; color: #64748b; cursor: not-allowed;">Masuk
                                Antrian</a>
                        </div>
                    </div>
                </div>

                <div class="book-card terbaru" style="display: none;">
                    <span class="book-badge" style="background: #10b981;">Tersedia</span>
                    <img src="https://images.unsplash.com/photo-1614850523296-d8c1af93d400?q=80&w=400" class="book-img">
                    <div class="book-info">
                        <h4>Web Dev Guide 2026</h4>
                        <p>Rak D-03 (Teknologi)</p>
                        <div class="book-meta">
                            <a href="#" class="btn btn-primary"
                                style="padding: 8px 20px; font-size: 0.8rem; width: 100%; text-align: center;">Booking
                                Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cta-section" data-aos="zoom-in">
            <div class="cta-card">
                <h2>Amankan Buku Incaranmu Sekarang</h2>
                <p>Jangan sampai kehabisan stok di rak. Lakukan Pre-Order (PO) melalui portal siswa dan ambil bukunya kapan
                    saja saat kamu di sekolah.</p>
                <a href="#" class="btn" style="background: white; color: var(--primary); padding: 15px 40px;">Buka Portal
                    Siswa</a>
            </div>
        </section>

        <footer>
            <div class="footer-content">
                <div class="footer-about">
                    <a href="#" class="footer-logo"><i class="fas fa-book-bookmark"></i> SIPERPUS</a>
                    <p>Sistem Manajemen Perpustakaan Terintegrasi untuk Warga Sekolah. Memudahkan akses literasi fisik
                        melalui teknologi digital.</p>
                </div>
                <div class="footer-links">
                    <h4>Navigasi</h4>
                    <ul>
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#layanan">Cara PO</a></li>
                        <li><a href="#koleksi">Katalog Rak</a></li>
                        <li><a href="#">Kontak Petugas</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Bantuan</h4>
                    <ul>
                        <li><a href="#">Lupa Password</a></li>
                        <li><a href="#">Aturan Peminjaman</a></li>
                        <li><a href="#">Denda & Sanksi</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h4>Sosial Media</h4>
                    <div style="display: flex; gap: 15px; font-size: 1.5rem;">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <p style="text-align: center; margin-top: 50px; font-size: 0.9rem;">&copy; 2026 SIPERPUS Digital - Sistem
                Booking Perpustakaan Sekolah. All rights reserved.</p>
        </footer>
    </body>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

@endsection
@push('scripts')
    @vite('resources/js/LandingPage/landing_page.js')
@endpush