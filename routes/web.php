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
    Route::patch('/users/{user}/activate', [Controllers\UserController::class, 'activateUser'])->name('users.activate');
    Route::patch('/users/{user}/deactivate', [Controllers\UserController::class, 'deactivateUser'])->name('users.deactivate');

    // Products routes
    Route::get('/products', [Controllers\ProductController::class, 'listProducts'])->name('products.index');
    Route::get('/products/create', [Controllers\ProductController::class, 'createProductView'])->name('products.create-view');
    Route::post('/products/create', [Controllers\ProductController::class, 'createProduct'])->name('products.create');
    Route::get('/products/{product}/edit', [Controllers\ProductController::class, 'editProductView'])->name('products.edit');
    Route::put('/products/{product}', [Controllers\ProductController::class, 'editProduct'])->name('products.update');
    Route::delete('/products/{product}', [Controllers\ProductController::class, 'deleteProduct'])->name('products.delete');
});

Route::prefix('owner')->name('owner.')->middleware(['auth', 'role:OWNER'])->group(function () {
    Route::get('/dashboard', [Controllers\Owner::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [Controllers\ProductController::class, 'listProducts'])->name('products.index');
    Route::get('/transactions', [Controllers\TransactionsController::class, 'listTransactions'])->name('transactions.list');
});

Route::prefix('kasir')->name('kasir.')->middleware(['auth', 'role:KASIR'])->group(function () {
    Route::get('/dashboard', [Controllers\Kasir::class, 'dashboard'])->name('dashboard');
    Route::get('/transactions', [Controllers\TransactionsController::class, 'listTransactions'])->name('transactions.list');
    Route::post('/keranjang/tambah', [Controllers\TransactionsController::class, 'tambahKeKeranjang'])->name('keranjang.tambah');
    Route::post('/keranjang/update-jumlah', [Controllers\TransactionsController::class, 'updateJumlah'])->name('keranjang.updateJumlah');
    Route::get('/keranjang/ambil-keranjang', [Controllers\TransactionsController::class, 'ambilKeranjang'])->name('keranjang.ambilKeranjang');
});
