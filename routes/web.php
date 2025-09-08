<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;
use App\Notifications\VerifyEmail;

// Route::get('/test-email', function () {
//     $user = \App\Models\User::first();
//     return (new VerifyEmail())->toMail($user);
// });

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

// Authentication Routes

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    // Route::get('/product/show', [ProductController::class, 'show'])->name('product.show');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store'); 
    Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    Route::patch('/product/restore/{id}', [ProductController::class, 'restore'])->name('product.restore');
    Route::delete('/product/forceDestroy/{id}', [ProductController::class, 'forceDestroy'])->name('product.forceDestroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/adminRole', [RoleController::class, 'index'])->name('adminRole.index');
    Route::get('/adminRole/create', [RoleController::class, 'create'])->name('adminRole.create');
    Route::post('/adminRole/store', [RoleController::class, 'store'])->name('adminRole.store');
    Route::post('/adminRole/update', [RoleController::class, 'update'])->name('adminRole.update');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/adminUser', [AdminUserController::class, 'index'])->name('adminUser.index');
    Route::get('/adminUser/create', [AdminUserController::class, 'create'])->name('adminUser.create');
    Route::post('/adminUser/store', [AdminUserController::class, 'store'])->name('adminUser.store');
    Route::get('/adminUser/edit/{id}', [AdminUserController::class, 'edit'])->name('adminUser.edit');
    Route::post('/adminUser/update', [AdminUserController::class, 'update'])->name('adminUser.update');
    Route::delete('/adminUser/delete/{id}', [AdminUserController::class, 'destroy'])->name('adminUser.delete');  
    Route::patch('/adminUser/restore/{id}', [AdminUserController::class, 'restore'])->name('adminUser.restore');
    Route::delete('/adminUser/forceDestroy/{id}', [AdminUserController::class, 'forceDestroy'])->name('adminUser.forceDestroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/carousel', [CarouselController::class, 'index'])->name('carousel.index');
    
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
});



require __DIR__.'/auth.php';
