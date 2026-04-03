<?php

use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\GenreController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
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


// Route test api
Route::get('/test', function () {
    return 'Route API aktif';
});



            











//  Route BookController 
// Route::get('/books', [BookController::class, 'index']);
// Route::get('/books/{id}', [BookController::class, 'show']);
// Route::post('/books/{id}', [BookController::class, 'store']);