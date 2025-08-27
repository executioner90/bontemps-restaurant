<?php

use App\Http\Controllers\Admin\Auth;
use Illuminate\Support\Facades\Route;

Route::resource('/register', Auth\RegisterController::class)
    ->only(['index', 'store']);

Route::resource('/login', Auth\LoginController::class)
    ->only(['index', 'store', 'destroy']);

Route::resource('/forgot-password', Auth\PasswordResetController::class)
    ->only(['index', 'store']);

Route::resource('/reset-password', Auth\NewPasswordController::class)
    ->only(['index', 'store']);


Route::middleware('auth:admin')->group(function () {
    Route::resource('/confirm-password', Auth\ConfirmablePasswordController::class)
        ->only(['index', 'store']);

    Route::get('confirm-password', [Auth\ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::get('verify-email/{id}/{hash}', Auth\VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [Auth\EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::post('confirm-password', [Auth\ConfirmablePasswordController::class, 'store']);

    Route::put('password', [Auth\PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [Auth\LoginController::class, 'destroy'])
                ->name('logout');
});
