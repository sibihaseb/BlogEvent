<?php

use App\Http\Controllers\Admin\ChurchEventBlogController;
use App\Http\Controllers\Admin\ChurchEventController;
use App\Http\Controllers\Admin\ChurchEventTypeController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('churchevents', ChurchEventController::class);
    Route::resource('church/event/types', ChurchEventTypeController::class);
    Route::resource('church/event/blogs', ChurchEventBlogController::class);
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
