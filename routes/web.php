<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('LandingPage/halaman_landing_page');
})      -> name('landing-page');

// route auth
Route::get('/login', function () {
    return view('Auth/Login/halaman_login');
})      -> name('login');
Route::get('/register', function () {
    return view('Auth/Register/halaman_register');
})      -> name('register');


// Route::get('/forgot-password', function () {
//     return view('Auth/ForgotPassword/forgot_password');
// })      -> name('forgot-password');
// Route::get('/reset-password', function () {
//     return view('Auth/ResetPassword/reset_password');
// })      -> name('reset-password');
// Route::get('/verify-email', function () {
//     return view('Auth/VerifyEmail/verify_email');
// })      -> name('verify-email');
// Route::get('/confirm-password', function () {
//     return view('Auth/ConfirmPassword/confirm_password');
// })      -> name('confirm-password');

// route admin dashboard
Route::get('/dashboard', function () {
    return view('Admin/dashboard/dashboard');
}) -> name('dashboard');

// route admin anggota
Route::get('/daftar-anggota', function () {
    return view('Admin/anggota/daftar_anggota');
})      -> name('daftar-anggota');
Route::get('/konfirmasi-pengguna', function () {
    return view('Admin/konfirmasi_pengguna/halaman_konfirmasi_pengguna');
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
Route::get('/daftar-genre', function () {
    return view('Admin/genre/daftar_genre');
})      -> name('daftar-genre');

// route admin Antrian
Route::get('/daftar-antrian', function () {
    return view('Admin/antrian/daftar_antrian');
})      -> name('daftar-antrian');
Route::get('/daftar-pengambilan', function () {
    return view('Admin/pengambilan/daftar_pengambilan');
})      -> name('daftar-pengambilan');

// route admin transaksi
Route::get('/daftar-peminjaman', function () {
    return view('Admin/Peminjaman/halaman_buku');
})      -> name('daftar-peminjaman');
Route::get('/daftar-pengembalian', function () {
    return view('Admin/Pengembalian/halaman_pengembalian');
})      -> name('daftar-pengembalian');
Route::get('/riwayat-transaksi', function () {
    return view('Admin/riwayat_transaksi/halaman_riwayat_transaksi');
})      -> name('riwayat-transaksi');

// route admin Laporan
Route::get('/statistik-laporan', function () {
    return view('Admin/statistik_laporan/halaman_laporan_statistik');
})      -> name('statistik-laporan');
Route::get('/buku-populer', function () {
    return view('Admin/transaksi/buku_populer');
})      -> name('buku-populer');

// route admin Settings
Route::get('/settings-admin', function () {
    return view('Admin/settings/settings_admin');
})      -> name('settings-admin');