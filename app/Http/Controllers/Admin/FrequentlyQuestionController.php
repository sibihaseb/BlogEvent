<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrequentlyQuestion;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FrequentlyQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $frequentlyQuestions = FrequentlyQuestion::query()
            ->filter($request->only('search'))
            ->orderBy('created_at', 'ASC')
            ->paginate(10);
        return Inertia::render('admin/fQuestions/Index', [
            'Questions' => $frequentlyQuestions,
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

        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'type' => 'required|string|in:about,home,contact,prayer',
            'is_active' => 'required|boolean',
        ]);

        FrequentlyQuestion::create($validated);

        return redirect()->route('frequently-questions.index')->with('message', 'Question created successfully.');
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

        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'type' => 'required|string|in:about,home,contact,prayer',
            'is_active' => 'required|boolean',
        ]);


        $frequentlyQuestion = FrequentlyQuestion::findOrFail($id);
        $frequentlyQuestion->update($validated);

        return redirect()->route('frequently-questions.index')->with('message', 'Question updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = FrequentlyQuestion::findOrfail($id);
        $data->delete();
    }
}
