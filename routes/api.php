<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/contact', [App\Http\Controllers\Api\ContactController::class, 'submit'])
    ->name('submit.contact');

Route::prefix('menu')
    ->as('menu.')
    ->group(function () {
        Route::get('/', [Api\MenuController::class, 'index'])
            ->name('get.all');

        Route::get('/search', [Api\MenuController::class, 'search'])
            ->name('search');

        Route::get('/{menu}/meals', [Api\MealController::class, 'index'])
            ->name('meals');

        Route::get('/{menu}/meals/search', [Api\MealController::class, 'search'])
            ->name('meals.search');
    });
