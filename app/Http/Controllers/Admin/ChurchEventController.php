<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\ChurchEvent;
use Illuminate\Http\Request;
use App\Models\ChurchEventTag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ChurchEventRequest;

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
    public function edit(ChurchEvent $churchevent)
    {
        return Inertia::render('admin/event/Edit', [
            'churchevent' => $churchevent
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChurchEventRequest $request, ChurchEvent $churchevent)
    {
        $input = $request->validated();
        if ($request->hasFile('picture')) {
            $ext = $input['picture']->getClientOriginalExtension();
            $filename = str_replace(' ', '', $input['name'] . '.' . $ext);
            $input['picture'] = $request->file('picture')->storeAs('churchevents', $filename, 'public');
            if (Storage::exists($churchevent->picture)) {
                Storage::delete($churchevent->picture);
            }
        } else {
            unset($input['picture']);
        }
        $churchevent->update($input);

        return redirect()
            ->route('churchevents.index')
            ->with('message', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ChurchEvent $churchevent)
    {
        if (Storage::exists($churchevent->picture)) {
            Storage::delete($churchevent->picture);
        }
        $churchevent->delete();

        return redirect()
            ->route('churchevents.index')
            ->with('message', 'Event deleted successfully');
    }
}
