<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChurchEventRequest;
use App\Models\ChurchEvent;
use App\Models\ChurchEventTag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChurchEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $churchevents = ChurchEvent::query()
            ->filter($request->only('search'))
            ->orderBy('created_at', 'ASC')
            ->paginate(10);

        return Inertia::render('admin/event/Index', [
            'churchevents' => $churchevents,
            'filters' => $request->only('search'),
            'message' => session('message'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin/event/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChurchEventRequest $request)
    {
        $input = $request->validated();
        $ext = $input['picture']->getClientOriginalExtension();
        $filename = str_replace(' ', '', $input['name'] . '.' . $ext);
        $input['picture'] = $request->file('picture')->storeAs('churchevents', $filename, 'public');

        ChurchEvent::create($input);

        return redirect()
            ->route('churchevents.index')
            ->with('message', 'Event created successfully');
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
        //
    }
}
