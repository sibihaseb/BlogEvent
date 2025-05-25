<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChurchEvent;
use App\Models\ChurchEventBlog;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $churchevents = ChurchEvent::take(3)->orderBy('created_at', 'desc')->get();
        $churcheventBlogs = ChurchEventBlog::take(3)->orderBy('created_at', 'desc')->get();
        return Inertia::render('Welcome', [
            'churchevents' => $churchevents,
            'churcheventBlogs' => $churcheventBlogs,
        ]);
    }

    public function churchEvents()
    {
        $churchevents = ChurchEvent::orderBy('created_at', 'desc')->get();
        return Inertia::render('frontend/ChurchEvent', [
            'churchevents' => $churchevents,
        ]);
    }

    public function singleEvent(ChurchEvent $churchevent)
    {
        return Inertia::render('frontend/SingleEvent', [
            'churchevent' => $churchevent,
        ]);
    }

    //  blogs
    public function churchEventBlogs()
    {

        $churcheventBlogs = ChurchEventBlog::orderBy('created_at', 'desc')->get();
        return Inertia::render('frontend/Blogs/Index', [
            'churcheventBlogs' => $churcheventBlogs,
        ]);
    }
    public function singleBlog(ChurchEventBlog $churcheventBlog)
    {
        return Inertia::render('frontend/Blogs/SingleBlog', [
            'churcheventBlog' => $churcheventBlog,
        ]);
    }
}
