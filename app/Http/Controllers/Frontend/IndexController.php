<?php

namespace App\Http\Controllers\Frontend;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ChurchEvent;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $churchevents = ChurchEvent::take(3)->orderBy('created_at', 'desc')->get();
        return Inertia::render('Welcome', [
            'churchevents' => $churchevents,
        ]);
    }

    public function churchEvents()
    {
        $churchevents = ChurchEvent::orderBy('created_at', 'desc')->get();
        return Inertia::render('frontend/ChurchEvent', [
            'churchevents' => $churchevents,
        ]);
    }
}
