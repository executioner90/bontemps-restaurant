<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MealController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\UserController;

require __DIR__ . '/auth.php';

Route::middleware(['auth:admin', 'verified', 'admin'])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])
            ->name('index');

        Route::resource('/users', UserController::class);
        Route::resource('/meals', MealController::class);
        Route::resource('/meals', MealController::class);
        Route::resource('/products', ProductController::class);
        Route::resource('/menus', MenuController::class);
        Route::resource('/tables', TableController::class);
        Route::resource('/reservations', ReservationController::class);
    });
