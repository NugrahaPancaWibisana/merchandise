<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::middleware('guest')->group(function () {
    Route::get('/', [Controllers\AuthenticationController::class, 'loginView']);
    Route::post('/', [Controllers\AuthenticationController::class, 'login'])->name('login');
});

Route::middleware('auth')->post('/logout', [Controllers\AuthenticationController::class, 'logout'])->name('logout');
