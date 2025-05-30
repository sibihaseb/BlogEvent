<?php

use App\Http\Controllers\Admin\ChurchEventBlogController;
use App\Http\Controllers\Admin\ChurchEventController;
use App\Http\Controllers\Admin\ChurchEventTypeController;
use App\Http\Controllers\Admin\MinistryController;
use App\Http\Controllers\Admin\EventStaffControlller;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/church-event', [IndexController::class, 'churchEvents'])->name('church.event');
Route::get('/church-event/{churchevent}', [IndexController::class, 'singleEvent'])->name('single.church.event');

// Blogs
Route::get('/event/blogs', [IndexController::class, 'churchEventBlogs'])->name('event.blogs');
Route::get('/church-event/blogs/{churcheventBlog}', [IndexController::class, 'singleBlog'])->name('single.church.event.blog');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('churchevents', ChurchEventController::class);
    Route::resource('church/event/types', ChurchEventTypeController::class);
    Route::resource('church/event/blogs', ChurchEventBlogController::class);
    Route::resource('ministries', MinistryController::class);
    Route::resource('staffs', EventStaffControlller::class);
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
