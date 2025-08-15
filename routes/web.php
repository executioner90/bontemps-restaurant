<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')
    ->group(__DIR__.'/frontend.php');

Route::middleware('auth')->group(function () {
    Route::get('/user', [ProfileController::class, 'edit'])
        ->name('user.edit');
    Route::patch('/user', [ProfileController::class, 'update'])
        ->name('user.update');
    Route::delete('/user', [ProfileController::class, 'destroy'])
        ->name('user.destroy');
});

Route::prefix('admin')
    ->as('admin.')
    ->group( __DIR__ . '/admin/web.php');

