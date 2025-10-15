<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\UserController;


// Route untuk UserController
Route::apiResource('users', UserController::class, );

// Route untuk BookController
Route::apiResource('books', BookController::class, );








//  Route BookController 
// Route::get('/books', [BookController::class, 'index']);
// Route::get('/books/{id}', [BookController::class, 'show']);
// Route::post('/books/{id}', [BookController::class, 'store']);


// Route Test
Route::get('/test', function () {
    return 'Route API aktif';
});
