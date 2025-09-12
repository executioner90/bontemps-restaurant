<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::middleware('auth:admin')
    ->middleware('verified')
    ->middleware('admin')
    ->group(function () {
        Route::get('/', [Admin\IndexController::class, 'index'])
            ->name('index');

        Route::resource('/user', Admin\UserController::class);
        Route::resource('/role', Admin\RoleController::class)
            ->middleware('super-admin');
        Route::resource('/meal', Admin\MealController::class);
        Route::resource('/product', Admin\ProductController::class);
        Route::resource('/menu', Admin\MenuController::class);
        Route::resource('/table', Admin\TableController::class);
        Route::resource('/reservation', Admin\ReservationController::class);

        // API routes
        Route::prefix('/api')
            ->as('api.')
            ->group(function () {
                Route::get('/reservation/available-times', [Admin\Api\ReservationController::class, 'getAvailableTimes'])
                    ->name('reservation.available-times.get');

                Route::get('/reservation', [Admin\Api\ReservationController::class, 'index'])
                    ->name('reservation.index');
            });
    });
