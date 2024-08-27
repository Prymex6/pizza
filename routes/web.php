<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.book');

Route::prefix('/dashboard')->group(function () {
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::resource('dish', DishController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('reservation', ReservationController::class);

    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::get('/setting/{code}/edit', [SettingController::class, 'edit'])->name('setting.edit');
    Route::put('/setting/{code}', [SettingController::class, 'update'])->name('setting.update');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
