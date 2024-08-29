<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SaveCurrentRoute;

Route::get('/', [HomeController::class, 'index'])->name('home.index')->middleware([SaveCurrentRoute::class]);
Route::get('/home', [HomeController::class, 'index'])->name('home.index')->middleware([SaveCurrentRoute::class]);
Route::get('/menu', [HomeController::class, 'menu'])->name('home.menu');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/reservation', [HomeController::class, 'reservation'])->name('home.reservation')->middleware([SaveCurrentRoute::class]);

Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.book');
Route::prefix('/dashboard')->group(function () {
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::resource('dish', DishController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('reservation', ReservationController::class)->middleware([SaveCurrentRoute::class]);
    Route::put('reservation/{reservation}/status', [ReservationController::class, 'status'])->name('reservation.status')->middleware([SaveCurrentRoute::class]);

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
