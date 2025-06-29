<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotifySetting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotifyEmailController extends Controller
{
    public function index()
    {

        // Logic to display the list of notification emails
        return Inertia::render('admin/notifySetting/Index', [
            'contactus' => NotifySetting::where('page', 'contactus')->first()->emails ?? '',
            'prayerrequest' => NotifySetting::where('page', 'prayerrequest')->first()->emails ?? '',
        ]);
    }

    public function storeNotifyEmail(Request $request)
    {
        $input = $request->validate([
            'contactus' => [function ($attribute, $value, $fail) {
                // Split the comma-separated string into an array
                $emails = array_map('trim', explode(',', $value));

                // Validate each email
                foreach ($emails as $email) {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $fail("The $attribute contains an invalid email: $email.");
                    }
                }
            }],
            'prayerrequest' => [function ($attribute, $value, $fail) {
                // Split the comma-separated string into an array
                $emails = array_map('trim', explode(',', $value));

                // Validate each email
                foreach ($emails as $email) {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $fail("The $attribute contains an invalid email: $email.");
                    }
                }
            }],
        ]);

        NotifySetting::updateOrCreate([
            'page' => 'contactus',
        ], [
            'emails' => $input['contactus']
        ]);

        NotifySetting::updateOrCreate([
            'page' => 'prayerrequest',
        ], [
            'emails' => $input['prayerrequest']
        ]);

        redirect()->route('notify.settings')
            ->with([
                'messages' => ['title' => 'Notification Setting Updated Successfully.'],
                'messageType' => 'success',
            ]);
    }
}
