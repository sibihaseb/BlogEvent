<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChurchEventBlogRequest;
use App\Http\Requests\ChurchEventRequest;
use App\Models\ChurchEventBlog;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChurchEventBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $churchEventBlogs = ChurchEventBlog::query()
            ->filter($request->only('search'))
            ->orderBy('created_at', 'ASC')
            ->paginate(10);

        return Inertia::render('admin/eventBlogs/index', [
            'churchEventBlogs' => $churchEventBlogs,
            'filters' => $request->only('search'),
            'message' => session('message'),
        ]);

        // Return the view with the data

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('admin/eventBlogs/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChurchEventBlogRequest $request)
    {


        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        ChurchEventBlog::create($data);

        return redirect()->route('blogs.index')->with('messages', ['title' => 'Church Event Blog created successfully.']);
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
        $blog = ChurchEventBlog::findOrFail($id);

        return Inertia::render('admin/eventBlogs/Edit', [
            'blog' => $blog,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChurchEventBlogRequest $request, ChurchEventBlog $blog)

    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('blogs.index')->with('messages', ['title' => 'Church Event Blog updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = ChurchEventBlog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index')->with('messages', ['title' => 'Church Event Blog deleted successfully.']);
    }
}
