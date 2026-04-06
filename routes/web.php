<?php

use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('sampah/welcome');
// })      -> name('/');

// Route::get('/halaman-admin', function () {
//     return view('Admin/dashboard/dashboard_improved');
// })      -> name('dashboard-admin');

// Route::get('/halaman-daftar-anggota', function () {
//     return view('Admin/anggota/halaman_anggota');
// });

// Route::get('/halaman-admin-inspirasi', function () {
//     return view('Admin/template/gemini/dashboard');
// });
// Route::get('/buku', function () {
//     return view('Admin/buku/halaman_buku');
// });


// route admin dashboard
Route::get('/dashboard', function () {
    return view('Admin/dashboard/dashboard');
}) -> name('dashboard');

// route admin anggota
Route::get('/daftar-anggota', function () {
    return view('Admin/anggota/daftar_anggota');
})      -> name('daftar-anggota');
Route::get('/konfirmasi-pengguna', function () {
    return view('Admin/anggota/konfirmasi_pengguna');
})      -> name('konfirmasi-pengguna');
Route::get('/edit-anggota', function () {
    return view('Admin/anggota/edit-anggota');
})      -> name('edit-anggota');
Route::get('/detail-anggota', function () {
    return view('Admin/anggota/detail-anggota');
})      -> name('detail-anggota');

// route admin buku
Route::get('/daftar-buku', function () {
    return view('Admin/buku/halaman_buku');
})      -> name('daftar-buku');
Route::get('/perbaikan-halaman-buku', function () {
    return view('Admin/buku/perbaikan_tabel_buku/perbaikan_buku');
})      -> name('perbaikan-halaman-buku');
Route::get('/daftar-genre', function () {
    return view('Admin/Genre/halaman-genre');
})      -> name('daftar-genre');
Route::get('/tambah-buku', function () {
    return view('Admin/buku/tambah_buku');
})      -> name('tambah-buku');
Route::get('/edit-buku', function () {
    return view('Admin/buku/edit_buku');
})      -> name('edit-buku');

// route admin Antrian
Route::get('/daftar-antrian', function () {
    return view('Admin/antrian/daftar_antrian');
})      -> name('daftar-antrian');
Route::get('/konfirmasi-ketersediaan', function () {
    return view('Admin/antrian/konfirmasi_ketersediaan');
})      -> name('konfirmasi-ketersediaan');
Route::get('/konfirmasi-peminjaman', function () {
    return view('Admin/antrian/konfirmasi_peminjaman');
})      -> name('konfirmasi-peminjaman');

// route admin transaksi
Route::get('/daftar-peminjaman', function () {
    return view('Admin/transaksi/daftar_peminjaman');
})      -> name('daftar-peminjaman');
Route::get('/daftar-pengembalian', function () {
    return view('Admin/transaksi/daftar_pengembalian');
})      -> name('daftar-pengembalian');

// route admin riwayat transaksi
Route::get('/riwayat-transaksi', function () {
    return view('Admin/transaksi/riwayat_transaksi/riwayat_transaksi');
})      -> name('riwayat-transaksi');
Route::get('/detail-transaksi', function () {
    return view('Admin/transaksi/riwayat_transaksi/detail_riwayat/detail_riwayat');
})      -> name('detail-transaksi');

// route admin Laporan
Route::get('/statistik-laporan', function () {
    return view('Admin/laporan/statistik_laporan');
})      -> name('statistik-laporan');
Route::get('/buku-populer', function () {
    return view('Admin/transaksi/buku_populer');
})      -> name('buku-populer');

// route admin Settings
Route::get('/settings-admin', function () {
    return view('Admin/settings/settings_admin');
})      -> name('settings-admin');