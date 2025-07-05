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

    public function homePage()
    {
        $data = FrontWebsitePage::where('key', 'homepage')->first();
        if ($data) {
            $data = json_decode($data->value, true);
        }
        return Inertia::render('admin/website/HomePage', [
            'homepage' => $data
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
        if ($request->hasFile('side_img')) {
            $ext = $input['side_img']->getClientOriginalExtension();
            $filename = str_replace(' ', '', 'sideposter' . '.' . $ext);
            $input['side_img'] = $request->file('side_img')->storeAs('website', $filename, 'public');
        }
        if ($request->hasFile('flag_icon')) {
            $ext = $input['flag_icon']->getClientOriginalExtension();
            $filename = str_replace(' ', '', 'flag_icon' . '.' . $ext);
            $input['flag_icon'] = $request->file('flag_icon')->storeAs('website', $filename, 'public');
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

    public function blogPage()
    {
        $blogPage = FrontWebsitePage::where('key', 'blog')->first();

        if ($blogPage) {
            $blogPage = json_decode($blogPage->value, true);
        }

        return Inertia::render('admin/website/Blog', [
            'blogPage' => $blogPage
        ]);
    }

    public function blogPageUpdate(Request $request)
    {
        $input = $request->all();
        $style = "1";
        if ($request->hasFile('heroimage')) {
            $ext = $input['heroimage']->getClientOriginalExtension();
            $filename = str_replace(' ', '', 'blog' . '.' . $ext);
            $input['heroimage'] = $request->file('heroimage')->storeAs('website', $filename, 'public');
            $style = $input['heroimage_style'];
        }

        FrontWebsitePage::updateOrCreate(
            ['key' => 'blog'],
            ['value' => json_encode($input, true)]
        );

        if ($request->hasFile('heroimage')) {
            $this->imageresize($input['heroimage'], $style);
        }

        return redirect()->route('website.blog')->with([
            'messages' => ['title' => 'Site Updated successfully'],
            'messageType' => 'success',
        ]);
    }

    public function prayerPage()
    {
        $prayerPage = FrontWebsitePage::where('key', 'prayer')->first();

        if ($prayerPage) {
            $prayerPage = json_decode($prayerPage->value, true);
        }
        return Inertia::render('admin/website/PrayerRequest', [
            'prayerPage' => $prayerPage
        ]);
    }

    public function prayerPageUpdate(Request $request)
    {
        $input = $request->all();
        $style = "1";
        if ($request->hasFile('heroimage')) {
            $ext = $input['heroimage']->getClientOriginalExtension();
            $filename = str_replace(' ', '', 'prayer' . '.' . $ext);
            $input['heroimage'] = $request->file('heroimage')->storeAs('website', $filename, 'public');
            $style = $input['heroimage_style'];
        }

        FrontWebsitePage::updateOrCreate(
            ['key' => 'prayer'],
            ['value' => json_encode($input, true)]
        );

        if ($request->hasFile('heroimage')) {
            $this->imageresize($input['heroimage'], $style);
        }

        return redirect()->route('website.prayer')->with([
            'messages' => ['title' => 'Site Updated successfully'],
            'messageType' => 'success',
        ]);
    }
}
