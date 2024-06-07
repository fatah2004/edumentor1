<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MentorsController extends Controller
{
    public function index(Request $request)
    {
         $search = $request->input('search');

        $query = User::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $users = $query->paginate(2);

        return view('mentors.index', compact('users'));
    }

    public function create()
    {
        return view('mentors.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_photo')) {
            $imagePath = $request->file('profile_photo')->store('profile_photos', 'public');
            $validatedData['profile_photo'] = $imagePath;
        }

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        return redirect()->route('mentors.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $attendedSessions = $user->attendedSessions()->pluck('title'); // Get titles of attended sessions
        $responsibleSessions = $user->responsibleSessions()->pluck('title'); // Get titles of responsible sessions

        return view('mentors.show', compact('user', 'attendedSessions', 'responsibleSessions'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('mentors.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8', // Allow password to be nullable
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->fill($validatedData);

        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }

        if ($request->hasFile('profile_photo')) {
            $imagePath = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $imagePath;
        }

        $user->save();

        return redirect()->route('mentors.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('mentors.index')->with('success', 'User deleted successfully.');
    }
}
