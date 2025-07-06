<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Ministry;
use App\Models\EventStaff;
use App\Models\ChurchEvent;
use Illuminate\Http\Request;
use App\Models\ChurchEventBlog;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\PrayerRequest;
use App\Models\Subscriber;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $events = ChurchEvent::count();
        $blogs = ChurchEventBlog::count();
        $ministries = Ministry::count();
        $churchmembers = EventStaff::count();
        $prayers = PrayerRequest::count();
        $contactquery = ContactUs::count();
        $subscribers = Subscriber::count();

        return Inertia::render('Dashboard', [
            'users' => $users,
            'events' => $events,
            'blogs' => $blogs,
            'ministries' => $ministries,
            'churchmembers' => $churchmembers,
            'prayers' => $prayers,
            'contactquery' => $contactquery,
            'subscribers' => $subscribers,
        ]);
    }
}
