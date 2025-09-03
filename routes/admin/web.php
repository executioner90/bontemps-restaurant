<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

require __DIR__ . '/auth.php';

Route::middleware('auth:admin')
    ->middleware('verified')
    ->middleware('admin')
    ->group(function () {
        Route::get('/', [Admin\IndexController::class, 'index'])
            ->name('index');

        Route::resource('/user', Admin\UserController::class);
        Route::resource('/meal', Admin\MealController::class);
        Route::resource('/product', Admin\ProductController::class);
        Route::resource('/menu', Admin\MenuController::class);
        Route::resource('/table', Admin\TableController::class);
        Route::resource('/reservation', Admin\ReservationController::class);

        // API route
        Route::get('api/reservation/available-times', [Admin\Api\ReservationController::class, 'getAvailableTimes'])
            ->name('reservation.available-times.get');
    });
