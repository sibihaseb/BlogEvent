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
    public function contactUsPage()
    {
        $contactUsPage = FrontWebsitePage::where('key', 'contactus')->first();

        if ($contactUsPage) {
            $contactUsPage = json_decode($contactUsPage->value, true);
        }
        // dd($contactUsPage);
        return Inertia::render('admin/website/ContactUs', [
            'contactUsPage' => $contactUsPage
        ]);
    }

    public function contactUsPageUpdate(Request $request)
    {
        $input = $request->all();
        FrontWebsitePage::updateOrCreate(
            ['key' => 'contactus'],
            ['value' => json_encode($input, true)]
        );

        return redirect()->route('website.contactus')->with([
            'messages' => ['title' => 'Site Updated successfully'],
            'messageType' => 'success',
        ]);
    }

      public function homePage()
    {
        $data = FrontWebsitePage::where('key', 'homepage')->first();
        if ($data) {
            $data = json_decode($data->value, true);
        }
        return Inertia::render('admin/website/HomePage', [
            'data' => $data
        ]);
    }

    public function homeUpdate(Request $request)
    {
        $input = $request->all();

        FrontWebsitePage::updateOrCreate(
            ['key' => 'homepage'],
            ['value' => json_encode($input, true)]
        );

        return redirect()->route('website.home')->with([
            'messages' => ['title' => 'Site Updated successfully'],
            'messageType' => 'success',
        ]);
    }
}
