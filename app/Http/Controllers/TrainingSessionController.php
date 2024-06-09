<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use Illuminate\Http\Request;
use App\Models\User;

class TrainingSessionController extends Controller
{
    public function index(Request $request)
{
    $query = TrainingSession::query();

    // Filter by title
    if ($request->filled('title')) {
        $query->where('title', 'like', '%' . $request->input('title') . '%');
    }

    // Filter by start date
    if ($request->filled('start_date')) {
        $query->whereDate('start_time', '>=', $request->input('start_date'));
    }

    // Filter by end date
    if ($request->filled('end_date')) {
        $query->whereDate('end_time', '<=', $request->input('end_date'));
    }

    // Paginate the results
    $sessions = $query->paginate(10);

    return view('training_sessions.index', compact('sessions'));
}



    public function create()
    {
        $users = User::all();
        return view('training_sessions.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'responsible_mentor_id' => 'nullable|exists:users,id',
            'attendees' => 'nullable|array',
            'attendees.*' => 'exists:users,id',
        ]);

        // Create the training session
        $session = TrainingSession::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
            'responsible_mentor_id' => $validatedData['responsible_mentor_id'],
        ]);

        // Attach attendees if any
        if (!empty($validatedData['attendees'])) {
            $session->users()->attach($validatedData['attendees']);
        }

        return redirect()->route('training_sessions.index')->with('success', 'Training session created successfully.');
    }

    public function show($id)
    {
        $session = TrainingSession::with('users', 'responsibleMentor')->findOrFail($id);
        return view('training_sessions.show', compact('session'));
    }
    
    public function edit($id)
    {
        $session = TrainingSession::findOrFail($id);
        $users = User::all();
        $selectedAttendees = $session->users()->pluck('users.id')->toArray();
        return view('training_sessions.edit', compact('session', 'users', 'selectedAttendees'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            'responsible_mentor_id' => 'nullable|exists:users,id',
            'attendees' => 'nullable|array',
            'attendees.*' => 'exists:users,id',
        ]);

        // Find the existing training session
        $session = TrainingSession::findOrFail($id);

        // Update the session details
        $session->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
            'responsible_mentor_id' => $validatedData['responsible_mentor_id'],
        ]);

        // Sync attendees if any
        if (!empty($validatedData['attendees'])) {
            $session->users()->sync($validatedData['attendees']);
        } else {
            $session->users()->detach(); // Remove all attendees if none are provided
        }

        return redirect()->route('training_sessions.index')->with('success', 'Training session updated successfully.');
    }

    public function destroy($id)
    {
        $session = TrainingSession::findOrFail($id);
        $session->delete();

        return redirect()->route('training_sessions.index')->with('success', 'Training session deleted successfully.');
    }
}
