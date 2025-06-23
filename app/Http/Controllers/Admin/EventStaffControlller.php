<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventStaffRequest;
use App\Models\EventStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class EventStaffControlller extends Controller
{
    public function index(Request $request)
    {
        $staffs = EventStaff::query()
            ->filter($request->only('search'))
            ->orderBy('created_at', 'ASC')
            ->paginate(10);

        return Inertia::render('admin/staffs/Index', [
            'staffs' => $staffs,
            'filters' => $request->only('search'),
            'message' => session('message'),
        ]);
    }

    public function store(EventStaffRequest $request)
    {
        $input = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('staff_images', 'public');
            $input['image'] = $imagePath;
        }

        EventStaff::create($input);

        return redirect()->route('staffs.index')->with('messages', [
            'title' => 'Staff created successfully.'
        ]);
    }

    public function update(EventStaffRequest $request, EventStaff $staff)
    {
        $input = $request->validated();

        if ($request->hasFile('image')) {
            $ext = $request->file('image')->getClientOriginalExtension();
            $filename = str_replace(' ', '', $input['name'] . '.' . $ext);
            $input['image'] = $request->file('image')->storeAs('staff_images', $filename, 'public');
            if (Storage::exists($staff->image)) {
                Storage::delete($staff->image);
            }
        }
        $staff->update($input);

        return redirect()->route('staffs.index')->with('messages', ['title' => 'Staff updated successfully.']);
    }

    public function destroy(string $id)
    {
        $staff = EventStaff::findOrFail($id);
        if (Storage::exists($staff->image)) {
            Storage::delete($staff->image);
        }
        $staff->delete();

        return redirect()->route('staffs.index')->with('messages', ['title' => 'Staff deleted successfully.']);
    }
}
