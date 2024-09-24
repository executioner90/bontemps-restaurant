<?php

use App\Http\Controllers\Admin\MealController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Frontend routes
require __DIR__.'/frontend.php';


Route::get('/dashboard', function () {
    // Check if logged user is admin.
    if (Auth::user()->rol_id === 1) {
        // View admin dashboard
        return view('admin.index');
    } else {
        // View regular dashboard
        return view('dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Admin routes
Route::middleware('admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])
            ->name('index');
        Route::resource('/users', UserController::class);
        Route::resource('/meals', MealController::class);
        Route::resource('/products', ProductController::class);
        Route::resource('/menus', MenuController::class);
        Route::resource('/tables', TableController::class);
        Route::resource('/reservations', ReservationController::class);
    });

// Login/logout routes
require __DIR__.'/auth.php';
