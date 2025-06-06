<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\PrayerRequest;
use App\Http\Requests\PrayerRequest as PrayerDataRequest;
use App\Http\Controllers\Controller;

class PrayerRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allprayers = PrayerRequest::query()
            ->filter($request->only('search'))
            ->orderBy('id', 'ASC')
            ->paginate(10);

        return Inertia::render('admin/prayer/Index', [
            'allprayers' => $allprayers,
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
    public function store(PrayerDataRequest $request)
    {
        $input = $request->validated();
        PrayerRequest::create($input);
        return redirect()->route('prayers.index')
            ->with('message', 'Prayer request created successfully.');
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
        $prayerid = PrayerRequest::findOrFail($id);
        $prayerid->delete();
        return redirect()->route('prayers.index')
            ->with('message', 'Prayer request deleted successfully.');
    }
}
