<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::prefix('/menus')
    ->as('menus.')
    ->group(
        function () {
            Route::get('/', [Frontend\MenuController::class, 'index'])
                ->name('index');

            Route::get('/{menu:name}', [Frontend\MenuController::class, 'show'])
                ->name('show');
        }
    );

Route::prefix('/reservation')
    ->as('reservation.')
    ->group(
        function () {
            Route::resource('/', Frontend\ReservationController::class)
                ->only(['create', 'store']);

            Route::get('/finish', [Frontend\ReservationController::class, 'finish'])
                ->name('finish');
        }
    );

Route::get('/about-us', [Frontend\AboutUsController::class, 'index'])
    ->name('about.us');

Route::get('/contact', [Frontend\ContactController::class, 'index'])
    ->name('contact');

Route::get('/terms', [Frontend\TermsController::class, 'index'])
    ->name('terms');
