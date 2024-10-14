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

Route::post('/contact', [Api\ContactController::class, 'submit'])
    ->name('submit.contact');

Route::prefix('menus')
    ->as('menus.')
    ->group(function () {
        Route::get('/', [Api\MenusController::class, 'index'])
            ->name('get.all');

        Route::get('/search', [Api\MenusController::class, 'search'])
            ->name('search');
    });


