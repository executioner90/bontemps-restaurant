<?php

use App\Http\Controllers\Admin\KindController;
use App\Http\Controllers\Admin\MealController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/menus', [\App\Http\Controllers\Frontend\MenuController::class, 'index'])->name('menus.index');
Route::get('/menus/{menu}', [\App\Http\Controllers\Frontend\MenuController::class, 'show'])->name('menus.show');
Route::get('/reservations/step-one', [\App\Http\Controllers\Frontend\ReservationController::class, 'stepOne'])->name('reservations.step.one');
Route::get('/reservations/step-two', [\App\Http\Controllers\Frontend\ReservationController::class, 'stepTwo'])->name('reservations.step.two');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin env. routes
Route::middleware('admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::resource('/meals', MealController::class);
        Route::resource('/products', ProductController::class);
        Route::resource('/kinds', KindController::class);
        Route::resource('/menus', MenuController::class);
        Route::resource('/tables', TableController::class);
        Route::resource('/reservations', ReservationController::class);
    });

//Login/logout routes
require __DIR__.'/auth.php';
