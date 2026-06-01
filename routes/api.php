<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// 1. Public Routes (Bisa diakses tanpa token/login)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// 2. Protected Routes (Wajib membawa Bearer Token yang valid)
Route::middleware('auth:sanctum')->group(function () {
    
    // Semua user yang login (role 'user' maupun 'admin') bisa mengakses ini
    Route::get('/items', function () {
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil akses data items nim 061'
        ], 200);
    });

    // Ditambahkan di sini: Hanya user yang login DAN memiliki role 'admin' yang bisa mengakses
    Route::delete('/items/{id}', function ($id) {
        return response()->json([
            'status' => 'success',
            'message' => 'Item dengan ID ' . $id . ' berhasil dihapus oleh Admin NIM 061.'
        ], 200);
    })->middleware('role:admin'); // Mengunci rute delete dengan custom middleware role

});