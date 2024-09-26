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

Route::prefix('/reservations')
    ->as('reservations.')
    ->group(
        function () {
            Route::get('/step-one', [Frontend\ReservationController::class, 'stepOne'])
                ->name('step.one');

            Route::post('/step-one', [Frontend\ReservationController::class, 'storeStepOne'])
                ->name('store.step.one');

            Route::get('/step-two', [Frontend\ReservationController::class, 'stepTwo'])
                ->name('step.two');

            Route::post('/step-two', [Frontend\ReservationController::class, 'storeStepTwo'])
                ->name('store.step.two');
        }
    );



Route::get('/thank-you', [HomeController::class, 'thankYou'])
    ->name('thank.you');

Route::get('/about-us', [Frontend\AboutUsController::class, 'index'])
    ->name('about.us');

Route::get('/contact', [Frontend\ContactController::class, 'index'])
    ->name('contact');

Route::get('/terms', [Frontend\TermsController::class, 'index'])
    ->name('terms');
