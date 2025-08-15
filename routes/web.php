<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')
    ->group(__DIR__.'/frontend.php');

Route::prefix('admin')
    ->as('admin.')
    ->group( __DIR__ . '/admin/web.php');

