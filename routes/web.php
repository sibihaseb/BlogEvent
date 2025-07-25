<?php

use App\Http\Controllers\Admin\ChurchEventBlogController;
use App\Http\Controllers\Admin\ChurchEventController;
use App\Http\Controllers\Admin\ChurchEventTypeController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MinistryController;
use App\Http\Controllers\Admin\EventStaffControlller;
use App\Http\Controllers\Admin\FrequentlyQuestionController;
use App\Http\Controllers\Admin\NotifyEmailController;
use App\Http\Controllers\Admin\PrayerRequestController;
use App\Http\Controllers\Admin\SubscriberController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebsitePageController;
use App\Http\Controllers\Frontend\IndexController;

Route::get('/', [IndexController::class, 'index'])->name('home');

//church events
Route::get('/church-event', [IndexController::class, 'churchEvents'])->name('church.event');
Route::get('/church-event/{churchevent}', [IndexController::class, 'singleEvent'])->name('single.church.event');

// Blogs
Route::get('/event/blogs', [IndexController::class, 'churchEventBlogs'])->name('event.blogs');
Route::get('/church-event/blogs/{churcheventBlog}', [IndexController::class, 'singleBlog'])->name('single.church.event.blog');

//contact us
Route::get('/contact-us', [IndexController::class, 'contactUs'])->name('contact.us');
Route::post('/querycontact', [ContactUsController::class, 'contactFormSubmit'])->name('contact.us.store');

//about us
Route::get('/about-us', [IndexController::class, 'aboutUs'])->name('about.us');

//prayer request
//contact us
Route::get('/prayer-request', [IndexController::class, 'prayerpage'])->name('prayer.page');
Route::post('/submit-prayer', [PrayerRequestController::class, 'prayerFormSubmit'])->name('prayer.store');

//allministery
Route::get('oursponsers', [IndexController::class, 'oursponsers'])->name('our.sponsers');
Route::get('/ministry/{ministry}', [IndexController::class, 'singleMinistry'])->name('single.ministry');

//post subscribes
Route::post('/subscribe/now', [SubscriberController::class, 'subscribe'])->name('subscriber.subscribe');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('churchevents', ChurchEventController::class);
    Route::resource('church/event/types', ChurchEventTypeController::class);
    Route::resource('church/event/blogs', ChurchEventBlogController::class);
    Route::resource('ministries', MinistryController::class);
    Route::resource('staffs', EventStaffControlller::class);
    Route::resource('contactus', ContactUsController::class);
    Route::resource('prayers', PrayerRequestController::class);
    Route::resource('frequently-questions', FrequentlyQuestionController::class);
    //subscriber
    Route::resource('subscriber', SubscriberController::class);
    //website pages
    Route::get('content/aboutus', [WebsitePageController::class, 'aboutUsPage'])->name('website.aboutus');
    Route::post('content/aboutus/update', [WebsitePageController::class, 'aboutUsPageUpdate'])->name('website.aboutus.update');
    // Contacts
    Route::get('content/contactus', [WebsitePageController::class, 'contactUsPage'])->name('website.contactus');
    Route::post('content/contactus/update', [WebsitePageController::class, 'contactUsPageUpdate'])->name('website.contactus.update');
    // Ministries
    Route::get('content/ministries', [WebsitePageController::class, 'ministriesPage'])->name('website.ministries');
    Route::post('content/ministries/update', [WebsitePageController::class, 'ministriesPageUpdate'])->name('website.ministries.update');
    // Event Page
    Route::get('content/events', [WebsitePageController::class, 'eventPage'])->name('website.event');
    Route::post('content/events/update', [WebsitePageController::class, 'eventPageUpdate'])->name('website.event.update');
    //website pages
    Route::get('content/home', [WebsitePageController::class, 'homePage'])->name('website.home');
    Route::post('content/home/update', [WebsitePageController::class, 'homeUpdate'])->name('website.home.update');
    // Blog Page
    Route::get('content/blog', [WebsitePageController::class, 'blogPage'])->name('website.blog');
    Route::post('content/blog/update', [WebsitePageController::class, 'blogPageUpdate'])->name('website.blog.update');
    // Prayer Page
    Route::get('content/prayer', [WebsitePageController::class, 'prayerPage'])->name('website.prayer');
    Route::post('content/prayer/update', [WebsitePageController::class, 'prayerPageUpdate'])->name('website.prayer.update');
    //notify settings
    Route::get('notify/settings', [NotifyEmailController::class, 'index'])->name('notify.settings');
    Route::post('notify/settings/update', [NotifyEmailController::class, 'storeNotifyEmail'])->name('notify.settings.update');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
