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
        // Handle uploaded icons for info_cards
        if ($request->has('info_cards')) {
            foreach ($request->info_cards as $index => $card) {
                unset($input['info_cards'][$index]['icon_preview']);
                // Check if file is uploaded
                if ($request->hasFile("info_cards.$index.icon")) {
                    $file = $request->file("info_cards.$index.icon");
                    $path = $file->store('uploads/icons', 'public');
                    $input['info_cards'][$index]['icon'] = $path;
                } elseif (isset($card['icon']) && is_string($card['icon'])) {
                    // Existing image path retained
                    $input['info_cards'][$index]['icon'] = $card['icon'];
                } else {
                    $input['info_cards'][$index]['icon'] = null;
                }
            }
        }

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
