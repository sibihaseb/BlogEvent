<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontWebsitePage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WebsitePageController extends Controller
{
    public function aboutUsPage()
    {
        $aboutUsPage = FrontWebsitePage::where('key', 'aboutus')->first();
        if ($aboutUsPage) {
            $aboutUsPage = json_decode($aboutUsPage->value, true);
        }
        return Inertia::render('admin/website/AboutUs', [
            'aboutUsPage' => $aboutUsPage
        ]);
    }

    public function aboutUsPageUpdate(Request $request)
    {
        $input = $request->all();

        FrontWebsitePage::updateOrCreate(
            ['key' => 'aboutus'],
            ['value' => json_encode($input, true)]
        );

        return redirect()->route('website.aboutus')->with([
            'messages' => ['title' => 'Site Updated successfully'],
            'messageType' => 'success',
        ]);
    }
}
