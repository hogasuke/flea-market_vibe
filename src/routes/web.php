<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;

Route::get('/', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/{item}', [ItemController::class, 'show'])->name('items.show');

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/items/{item}/like', [LikeController::class, 'toggle'])->name('items.like');
    Route::get('/mypage', [AuthController::class, 'index']);
    Route::get('/mypage/profile', function () {
        return view('profile');
    });
});
