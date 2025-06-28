<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use App\Models\Ministry;
use App\Models\ChurchEvent;
use Illuminate\Http\Request;
use App\Models\ChurchEventBlog;
use App\Models\FrontWebsitePage;
use App\Models\FrequentlyQuestion;
use App\Http\Controllers\Controller;
use App\Models\EventStaff;

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
        return Inertia::render('frontend/Events/ChurchEvent', [
            'churchevents' => $churchevents,
        ]);
    }

    public function singleEvent(ChurchEvent $churchevent)
    {
        return Inertia::render('frontend/Events/SingleEvent', [
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

    public function contactUs()
    {
        $fQuestions = FrequentlyQuestion::active()->where('type', 'contact')->get()->map(function ($item) {
            return [
                'value' => 'item-' . $item->id,
                'title' => $item->question,
                'content' => $item->answer,
            ];
        });
        $contactUsPage = FrontWebsitePage::where('key', 'contactus')->first();
        if ($contactUsPage) {
            $contactUsPage = json_decode($contactUsPage->value, true);
        }
        return Inertia::render('frontend/ContactUs', [
            'appUrl' => env('APP_URL'),
            'fQuestions' => $fQuestions,
            'contactUsPage' => $contactUsPage
        ]);
    }

    public function aboutUs()
    {
        $fQuestions = FrequentlyQuestion::active()->where('type', 'about')->get()->map(function ($item) {
            return [
                'value' => 'item-' . $item->id,
                'title' => $item->question,
                'content' => $item->answer,
            ];
        });
        $aboutUsPage = FrontWebsitePage::where('key', 'aboutus')->first();
        if ($aboutUsPage) {
            $aboutUsPage = json_decode($aboutUsPage->value, true);
        }
        $eventstaff = EventStaff::orderBy('created_at', 'desc')->get();
        return Inertia::render('frontend/AboutUs', [
            'fQuestions' => $fQuestions,
            'aboutUsPage' => $aboutUsPage,
            'eventstaff' => $eventstaff,

        ]);
    }

    public function prayerpage()
    {
        $fQuestions = FrequentlyQuestion::active()->where('type', 'prayer')->get()->map(function ($item) {
            return [
                'value' => 'item-' . $item->id,
                'title' => $item->question,
                'content' => $item->answer,
            ];
        });
        return Inertia::render('frontend/PrayerRequest', [
            'fQuestions' => $fQuestions

        ]);
    }

    public function oursponsers()
    {
        $ministryPage = FrontWebsitePage::where('key', 'ministries')->first();
        if ($ministryPage) {
            $ministryPage = json_decode($ministryPage->value, true);
        }
        $allministries = Ministry::all();
        return Inertia::render('frontend/OurMinistery/Index', [
            'allministries' => $allministries,
            'ministryPage' => $ministryPage,
        ]);
    }
}
