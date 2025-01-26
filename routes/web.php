<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:ADMIN'])->group(function () {
    Route::get('/dashboard', [Controllers\Admin::class, 'dashboard'])->name('dashboard');

    // Users routes
    Route::get('/users', [Controllers\UserController::class, 'listUsers'])->name('users.index');
    Route::get('/users/create', [Controllers\UserController::class, 'createUserView'])->name('users.create-view');
    Route::post('/users/create', [Controllers\UserController::class, 'createUser'])->name('users.create');
    Route::get('/users/{user}/edit', [Controllers\UserController::class, 'editUserView'])->name('users.edit');
    Route::put('/users/{user}', [Controllers\UserController::class, 'editUser'])->name('users.update');
    Route::delete('/users/{user}', [Controllers\UserController::class, 'deleteUser'])->name('users.delete');

    // Products routes
    Route::get('/products', [Controllers\ProductController::class, 'listProducts'])->name('products.index');
    Route::get('/products/create', [Controllers\ProductController::class, 'createProductView'])->name('products.create-view');
    Route::post('/products/create', [Controllers\ProductController::class, 'createProduct'])->name('products.create');
    Route::get('/products/{product}/edit', [Controllers\ProductController::class, 'editProductView'])->name('products.edit');
    Route::put('/products/{product}', [Controllers\ProductController::class, 'editProduct'])->name('products.update');
    Route::delete('/products/{product}', [Controllers\ProductController::class, 'deleteProduct'])->name('products.delete');
});
