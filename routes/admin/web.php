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

Route::middleware('auth:admin')
    ->middleware('verified')
    ->middleware('admin')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])
            ->name('index');

        Route::resource('/user', UserController::class);
        Route::resource('/meal', MealController::class);
        Route::resource('/product', ProductController::class);
        Route::resource('/menu', MenuController::class);
        Route::resource('/table', TableController::class);
        Route::resource('/reservation', ReservationController::class);
    });
