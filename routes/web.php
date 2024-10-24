<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/', [ProductController::class, 'index'])->name('product.index'); // ->middleware('verified')
Route::get('/welcome/show', [ProductController::class, 'show'])->name('product.show');
Route::get('/welcome/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::get('/welcome/create', [ProductController::class, 'create'])->name('product.create'); //->middleware('check-permission:manage-users');
Route::post('/welcome/store', [ProductController::class, 'store'])->name('product.store'); //->middleware('can:create,product');
Route::post('/welcome/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::post('/welcome/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/////////////   Temporal //////////////////////
Route::get('/adminRoot', function () {
    return Inertia::render('Admin-Root');
})->middleware(['auth', 'verified'])->name('adminRoot');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//////////////////////////////////////////////


require __DIR__.'/auth.php';
