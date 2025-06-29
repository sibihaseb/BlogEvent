<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allContacts = ContactUs::query()
            ->filter($request->only('search'))
            ->orderBy('created_at', 'ASC')
            ->paginate(10);

        return Inertia::render('admin/contactus/Index', [
            'allContacts' => $allContacts,
            'filters' => $request->only('search'),
            'message' => session('message'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contactUs = ContactUs::findOrFail($id);
        $contactUs->delete();

        return redirect()->route('contactus.index')->with('messages', ['title' => 'Query deleted successfully.']);
    }

    public function contactFormSubmit(Request $request)
    {
        $input = $request->all();
        ContactUs::create($input);
        return redirect()->back()->with('message', 'Thank you for contacting us! We will get back to you soon.');
    }
}
