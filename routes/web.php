<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RootController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('product.index');
Route::get('/welcome/show', [ProductController::class, 'show'])->name('product.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/welcome/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::get('/welcome/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/welcome/store', [ProductController::class, 'store'])->name('product.store'); 
    Route::post('/welcome/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('/welcome/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/adminRoot', [RootController::class, 'index'])->name('adminRoot.index');
    Route::post('/welcome/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
    Route::post('/welcome/forceDestroy/{id}', [ProductController::class, 'forceDestroy'])->name('product.forceDestroy');
});




require __DIR__.'/auth.php';
