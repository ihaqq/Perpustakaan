<?php

use App\Http\Controllers\API\AnggotaController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\GenreController;
use App\Http\Controllers\API\KelasController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;


// Route UserController (testing)
Route::apiResource('users', UserController::class, );

// Route Books
Route::apiResource('books', BookController::class);

// Route Genre
Route::get('genre/list', [GenreController::class, 'GetAll']);
Route::apiResource('genre', GenreController::class);


// Route Peserta
Route::apiResource('anggota', AnggotaController::class,);

// Route Kelas
Route::get('kelas/list', [KelasController::class, 'getAll']);
Route::apiResource('kelas', KelasController::class,);