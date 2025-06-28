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
        // dd($input['heroimage']);
        FrontWebsitePage::updateOrCreate(
            ['key' => 'aboutus'],
            ['value' => json_encode($input, true)]
        );

        if ($request->hasFile('heroimage')) {
            $this->imageresize($input['heroimage'], $style);
        }

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

        if ($request->hasFile('heroimage')) {
            $this->imageresize($input['heroimage'], $style);
        }

        return redirect()->route('website.contactus')->with([
            'messages' => ['title' => 'Site Updated successfully'],
            'messageType' => 'success',
        ]);
    }

    public function ministriesPage()
    {
        $ministriesPage = FrontWebsitePage::where('key', 'ministries')->first();

        if ($ministriesPage) {
            $ministriesPage = json_decode($ministriesPage->value, true);
        }

        return Inertia::render('admin/website/Ministry', [
            'ministriesPage' => $ministriesPage
        ]);
    }

    public function ministriesPageUpdate(Request $request)
    {
        $input = $request->all();
        $style = "1";
        if ($request->hasFile('heroimage')) {
            $ext = $input['heroimage']->getClientOriginalExtension();
            $filename = str_replace(' ', '', 'ministries' . '.' . $ext);
            $input['heroimage'] = $request->file('heroimage')->storeAs('website', $filename, 'public');
            $style = $input['heroimage_style'];
        }

        FrontWebsitePage::updateOrCreate(
            ['key' => 'ministries'],
            ['value' => json_encode($input, true)]
        );

        if ($request->hasFile('heroimage')) {
            $this->imageresize($input['heroimage'], $style);
        }

        return redirect()->route('website.ministries')->with([
            'messages' => ['title' => 'Site Updated successfully'],
            'messageType' => 'success',
        ]);
    }

    public function eventPage()
    {
        $eventPage = FrontWebsitePage::where('key', 'event')->first();

        if ($eventPage) {
            $eventPage = json_decode($eventPage->value, true);
        }

        return Inertia::render('admin/website/EventPage', [
            'eventPage' => $eventPage
        ]);
    }

    public function eventPageUpdate(Request $request)
    {
        $input = $request->all();
        $style = "1";
        if ($request->hasFile('heroimage')) {
            $ext = $input['heroimage']->getClientOriginalExtension();
            $filename = str_replace(' ', '', 'event' . '.' . $ext);
            $input['heroimage'] = $request->file('heroimage')->storeAs('website', $filename, 'public');
            $style = $input['heroimage_style'];
        }

        FrontWebsitePage::updateOrCreate(
            ['key' => 'event'],
            ['value' => json_encode($input, true)]
        );

        if ($request->hasFile('heroimage')) {
            $this->imageresize($input['heroimage'], $style);
        }

        return redirect()->route('website.event')->with([
            'messages' => ['title' => 'Site Updated successfully'],
            'messageType' => 'success',
        ]);
    }
}
