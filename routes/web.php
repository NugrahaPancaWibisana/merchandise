<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:ADMIN'])->group(function () {
    Route::get('/dashboard', [Controllers\Admin::class, 'dashboard'])->name('dashboard');

    // Users routes
    Route::get('/users', [Controllers\UserController::class, 'listUsers'])->name('users.index');
    Route::get('/users/add', [Controllers\UserController::class, 'addUserView'])->name('users.add-view');
    Route::post('/users/add', [Controllers\UserController::class, 'addUser'])->name('users.add');
    Route::get('/users/{user}/edit', [Controllers\UserController::class, 'editUserView'])->name('users.edit');
    Route::put('/users/{user}', [Controllers\UserController::class, 'editUser'])->name('users.update');
    Route::delete('/users/{user}', [Controllers\UserController::class, 'deleteUser'])->name('users.delete');
});
