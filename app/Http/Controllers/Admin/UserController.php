<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::query()
            ->filter($request->only('search'))
            ->orderBy('created_at', 'ASC')
            ->paginate(10);

        return Inertia::render('admin/users/Index', [
            'users' => $users,
            'filters' => $request->only('search'),
            'message' => session('message'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $input = $request->validated();
        // $temppassword = $input['password'];
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        // $user->sendEmailVerificationNotificationUser($temppassword);

        return redirect()->route('users.index')->with('messages', ['title' => 'User Created successfully.']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $input = $request->validated();

        if (isset($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }

        DB::transaction(function () use ($user, $input) {
            $user->update($input);
        }, 2);

        return redirect()->route('users.index')->with('messages', ['title' => 'User Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('messages', ['title' => 'User deleted successfully.']);
    }
}
