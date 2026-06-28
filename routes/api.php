<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;

// Rute Publik (Bisa diakses tanpa login/token)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rute Terproteksi (Wajib menyertakan Authorization Bearer Token & Rate Limiting)
// Tambahan 'throttle:60,1' ada di sini untuk jawaban Soal 4
Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    
    // Rute CRUD Otomatis untuk Items dan Categories
    Route::apiResource('items', ItemController::class);
    Route::apiResource('categories', CategoryController::class);
    
    // Rute optional untuk mengecek data user yang sedang login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
});