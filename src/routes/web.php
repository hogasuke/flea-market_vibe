<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;

Route::get('/', [ItemController::class,'index']);

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/mypage', [AuthController::class, 'index']);
    Route::get('/mypage/profile', function () {
        return view('profile');
    });
});
