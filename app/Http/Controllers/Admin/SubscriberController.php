<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        $subscriber = Subscriber::query()
            ->filter($request->only('search'))
            ->orderBy('created_at', 'ASC')
            ->paginate(10);

        return Inertia::render('admin/subscriber/Index', [
            'subscribers' => $subscriber,
            'filters' => $request->only('search'),
            'message' => session('message'),
        ]);
    }
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        Subscriber::create([
            'email' => $validated['email'],
        ]);

        return back()->with('success', 'You have been subscribed successfully.');
    }
      public function destroy(string $id)
    {
        $data = Subscriber::findOrFail($id);
        $data->delete();

        return redirect()->route('subscriber.index')->with('messages', ['title' => 'Deleted successfully.']);
    }
}
