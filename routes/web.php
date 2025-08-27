<?php


use App\Http\Controllers\Admin\Auth\NewPasswordController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')
    ->group(__DIR__.'/frontend.php');

Route::prefix('admin')
    ->as('admin.')
    ->group( __DIR__ . '/admin/web.php');

// special case for auth routes (not under admin)
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');
