<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;


// Mendefinisikan route API menggunakan apiResource sesuai permintaan soal
Route::apiResource('categories', CategoryController::class);
Route::apiResource('items', ItemController::class);