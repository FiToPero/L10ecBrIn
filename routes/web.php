<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\RootController;
use App\Http\Controllers\CarouselController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

// Authentication Routes

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    // Route::get('/product/show', [ProductController::class, 'show'])->name('product.show');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store'); 
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

    Route::patch('/product/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
    Route::delete('/product/forceDestroy/{id}', [ProductController::class, 'forceDestroy'])->name('product.forceDestroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/adminRoleUser', [RootController::class, 'index'])->name('adminRoleUser.index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/adminUser', [AdminUserController::class, 'index'])->name('adminUser.index');
    Route::get('/adminUser/create', [AdminUserController::class, 'create'])->name('adminUser.create');
    Route::post('/adminUser/store', [AdminUserController::class, 'store'])->name('adminUser.store');
    Route::get('/adminUser/edit/{id}', [AdminUserController::class, 'edit'])->name('adminUser.edit');
    Route::put('/adminUser/update/{id}', [AdminUserController::class, 'update'])->name('adminUser.update');
    Route::delete('/adminUser/delete/{id}', [AdminUserController::class, 'destroy'])->name('adminUser.delete');   
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/carousel', [CarouselController::class, 'index'])->name('carousel.index');
    
});

require __DIR__.'/auth.php';
