<?php

use App\Http\Controllers\Admin\ChurchEventController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/church-event', [IndexController::class, 'churchEvents'])->name('church.event');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('churchevents', ChurchEventController::class);
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
