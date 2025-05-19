<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChurchEventType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChurchEventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $eventTypes = ChurchEventType::query()
            ->filter($request->only('search'))
            ->orderBy('id', 'ASC')
            ->paginate(10);

        return Inertia::render('admin/eventType/Index', [
            'eventTypes' => $eventTypes,
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        ChurchEventType::create($data);
        return redirect()->route('types.index')->with('messages', ['title' => 'Event Type Created Successfully']);
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $eventType = ChurchEventType::findOrFail($id);
        $eventType->update($data);
        return redirect()->route('types.index')->with('message', ['title' =>  'Event Type Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $eventType = ChurchEventType::findOrFail($id);
        $eventType->delete();
        return redirect()->route('types.index')->with('messages', ['title' => 'Event Type Deleted Successfully']);
    }
}
