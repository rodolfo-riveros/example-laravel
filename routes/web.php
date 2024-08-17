<?php

use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home.index');
    Route::get('categoria', [CategoriaController::class, 'index'])->name('categoria.index');
    Route::post('categoria', [CategoriaController::class, 'store'])->name('categoria.store');
    Route::put('categoria/{id}', [CategoriaController::class, 'update'])->name('categoria.update');
    Route::delete('categoria/{id}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');
});

require __DIR__.'/auth.php';
