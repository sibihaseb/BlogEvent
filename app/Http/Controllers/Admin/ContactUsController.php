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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
        // dd($request->all());
        $input = $request->all();
        ContactUs::create($input);
        return redirect()->back()->with('message', 'Thank you for contacting us! We will get back to you soon.');
    }
}
