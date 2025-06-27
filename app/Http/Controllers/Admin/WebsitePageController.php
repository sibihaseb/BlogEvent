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
        $style = "1";
        if ($request->hasFile('heroimage')) {
            $ext = $input['heroimage']->getClientOriginalExtension();
            $filename = str_replace(' ', '', 'AboutUs' . '.' . $ext);
            $input['heroimage'] = $request->file('heroimage')->storeAs('website', $filename, 'public');
            $style = $input['heroimage_style']; // Default to '1' if not set
        }

        FrontWebsitePage::updateOrCreate(
            ['key' => 'aboutus'],
            ['value' => json_encode($input, true)]
        );

        $this->imageresize($input['heroimage'], $style);

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

        return Inertia::render('admin/website/ContactUs', [
            'contactUsPage' => $contactUsPage
        ]);
    }

    public function contactUsPageUpdate(Request $request)
    {
        $input = $request->all();
        $style = "1";
        if ($request->hasFile('heroimage')) {
            $ext = $input['heroimage']->getClientOriginalExtension();
            $filename = str_replace(' ', '', 'ContactUs' . '.' . $ext);
            $input['heroimage'] = $request->file('heroimage')->storeAs('website', $filename, 'public');
            $style = $input['heroimage_style'];
        }

        FrontWebsitePage::updateOrCreate(
            ['key' => 'contactus'],
            ['value' => json_encode($input, true)]
        );

        $this->imageresize($input['heroimage'], $style);

        return redirect()->route('website.contactus')->with([
            'messages' => ['title' => 'Site Updated successfully'],
            'messageType' => 'success',
        ]);
    }
}
