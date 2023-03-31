<?php

use App\Http\Controllers\Admin\KindController;
use App\Http\Controllers\Admin\MealController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index']);

// Frontend routes(customers)
Route::get('/menus', [\App\Http\Controllers\Frontend\MenuController::class, 'index'])
    ->name('menus.index');
Route::get('/menus/{menu}', [\App\Http\Controllers\Frontend\MenuController::class, 'show'])
    ->name('menus.show');
Route::get('/reservations/step-one', [\App\Http\Controllers\Frontend\ReservationController::class, 'stepOne'])
    ->name('reservations.step.one');
Route::post('/reservations/step-one', [\App\Http\Controllers\Frontend\ReservationController::class, 'storeStepOne'])
    ->name('reservations.store.step.one');
Route::get('/reservations/step-two', [\App\Http\Controllers\Frontend\ReservationController::class, 'stepTwo'])
    ->name('reservations.step.two');
Route::post('/reservations/step-two', [\App\Http\Controllers\Frontend\ReservationController::class, 'storeStepTwo'])
    ->name('reservations.store.step.two');
Route::get('/thank-you', [WelcomeController::class, 'thankYou'])
    ->name('thank.you');

// Admin welcome page.
Route::get('/dashboard', function () {
    // Check if logged user is admin.
    if (Auth::user()->is_admin) {
        // View admin dashboard
        return view('admin.index');
    } else {
        // View regular dashboard
        return view('dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Admin routes
Route::middleware('admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])
            ->name('index');
        Route::resource('/users', UserController::class);
        Route::resource('/meals', MealController::class);
        Route::resource('/products', ProductController::class);
        Route::resource('/kinds', KindController::class);
        Route::resource('/menus', MenuController::class);
        Route::resource('/tables', TableController::class);
        Route::resource('/reservations', ReservationController::class);
    });

// Login/logout routes
require __DIR__.'/auth.php';
