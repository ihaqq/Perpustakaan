<?php

use App\Http\Controllers\API\AnggotaController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\GenreController;
use App\Http\Controllers\API\KelasController;
use App\Http\Controllers\API\PeminjamanController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;


// Route UserController (testing)
Route::apiResource('users', UserController::class, );

// Route Books
Route::get('books/total', [BookController::class, 'totalBooks']);
Route::apiResource('books', BookController::class);

// Route Genre
Route::get('genre/list', [GenreController::class, 'GetAll']);
Route::apiResource('genre', GenreController::class);


// Route Peserta
Route::get('anggota/total', [AnggotaController::class, 'totalAnggota']);    
Route::apiResource('anggota', AnggotaController::class,);

// Route Kelas
Route::get('kelas/list', [KelasController::class, 'getAll']);
Route::apiResource('kelas', KelasController::class,);

// Route Peminjaman
Route::prefix('admin')->group(function () {
    // Menambahkan Peminjaman
    Route::post('/peminjaman', [PeminjamanController::class, 'store']);
    
    // Admin mengkonfirmasi buku diambil
    Route::put('/peminjaman/{id}/pengambilan', [PeminjamanController::class, 'ambilBuku']);
    
    // Admin menyelesaikan pengembalian (sudah termasuk denda)
    Route::put('/peminjaman/{id}/pengembalian', [PeminjamanController::class, 'kembalikanBuku']);
});