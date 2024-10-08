<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminAccess;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\SaveCurrentRoute;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index')->middleware([SaveCurrentRoute::class]);
Route::get('/home', [HomeController::class, 'index'])->name('home.index')->middleware([SaveCurrentRoute::class]);
Route::get('/menu', [HomeController::class, 'menu'])->name('home.menu');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
Route::get('/reservation', [HomeController::class, 'reservation'])->name('home.reservation')->middleware([SaveCurrentRoute::class]);
Route::get('/modalCart', [HomeController::class, 'modalCart'])->name('home.modalCart');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware([SaveCurrentRoute::class]);
Route::post('/cart/add', [CartController::class, 'addDish'])->name('cart.add')->middleware([SaveCurrentRoute::class]);
Route::put('/cart/update', [CartController::class, 'updateQuantity'])->name('cart.update')->middleware([SaveCurrentRoute::class]);
Route::delete('/cart/destroy', [CartController::class, 'removeDish'])->name('cart.destroy')->middleware([SaveCurrentRoute::class]);

Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.book');
Route::post('/order/store', [OrderController::class, 'store'])->name('order.add');
Route::middleware(['auth', 'verified', Authenticate::class])->prefix('/dashboard')->group(function () {
    Route::middleware([AdminAccess::class])->group(function () {
        Route::get('order/statuses', [OrderController::class, 'showStatuses'])->name('order.showStatuses');
        Route::put('order/statuses', [OrderController::class, 'updateStatuses'])->name('order.updateStatuses');
        Route::resource('order', OrderController::class)->middleware([SaveCurrentRoute::class])->except('index');
        Route::get('dish/sizes', [DishController::class, 'showSizes'])->name('dish.showSizes');
        Route::resource('dish', DishController::class);
        Route::resource('user', UserController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('reservation', ReservationController::class)->middleware([SaveCurrentRoute::class])->except('index');
        Route::put('reservation/{reservation}/status', [ReservationController::class, 'status'])->name('reservation.status')->middleware([SaveCurrentRoute::class]);
        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::get('/setting/{code}/edit', [SettingController::class, 'edit'])->name('setting.edit');
        Route::put('/setting/{code}', [SettingController::class, 'update'])->name('setting.update');
    });

    Route::get('order', [OrderController::class, 'index'])->name('order.index');
    Route::get('reservation', [ReservationController::class, 'index'])->name('reservation.index');
})->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
