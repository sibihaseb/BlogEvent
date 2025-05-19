<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MinistryRequest;
use App\Models\Ministry;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MinistryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ministries = Ministry::query()
            ->filter($request->only('search'))
            ->orderBy('created_at', 'ASC')
            ->paginate(10);

        return Inertia::render('admin/ministries/index', [
            'ministries' => $ministries,
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
    public function store(MinistryRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('ministry', 'public');
        }

        Ministry::create($data);

        return redirect()->route('ministries.index')->with('messages', ['title' => 'Ministry created successfully.']);
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
    public function update(MinistryRequest $request, Ministry $ministry)

    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('ministry', 'public');
        }
        $ministry->update($data);

        return redirect()->route('ministries.index')->with('messages', ['title' => 'Ministry updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ministry = Ministry::findOrFail($id);
        $ministry->delete();

        return redirect()->route('ministries.index')->with('messages', ['title' => 'Ministry deleted successfully.']);
    }
}
