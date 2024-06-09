<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingSession;
use Illuminate\Support\Facades\Auth;
use App\Models\PostTrainingSession;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isResponsible = TrainingSession::where('responsible_mentor_id', $user->id)->exists();

        return view('dashboard', compact('isResponsible'));
    }

    public function trainingSessions()
    {
        $user = Auth::user();
        
        $attendedSessions = $user->attendedSessions->map(function ($session) use ($user) {
            // Check if a post-training session exists for the attended session and belongs to the user
            $session->hasPostSession = $session->postTrainingSessions()->whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })->exists();
            return $session;
        });
    
        
        // Separate regular sessions and post sessions
        $regularSessions = $attendedSessions->reject(function ($session) {
            return $session->hasPostSession;
        });
        
        $postSessions = $attendedSessions->filter(function ($session) {
            return $session->hasPostSession;
        });
        
        return view('user.training_sessions', compact('regularSessions', 'postSessions'));
    }
    
    public function responsibleSessions()
{
    $user = Auth::user();
    $currentDateTime = now()->timezone('Africa/Casablanca'); // Set the timezone to Casablanca

    $sessions = $user->responsibleSessions->map(function ($session) {
        // Check if a post-training session exists for the responsible session
        $session->hasPostSession = $session->postTrainingSessions()->exists();
        return $session;
    });

    return view('user.responsible_sessions', compact('sessions', 'currentDateTime'));
}

    
    public function showSessionForm($sessionId)
{
    $session = TrainingSession::with('users')->findOrFail($sessionId);
    return view('user.session_form', compact('session'));
}


public function createPostTrainingSession(Request $request, $sessionId)
{
    $session = TrainingSession::with('users')->findOrFail($sessionId);

    // Check if a post-training session already exists
    if ($session->postTrainingSessions()->exists()) {
        return redirect()->route('responsible_sessions.submit', $sessionId)
            ->with('error', 'A post-training session has already been created for this session.');
    }

    // Create the post-training session
    $postSession = new PostTrainingSession();
    $postSession->title = $session->title . ' - Post Training';
    $postSession->description = $session->description;
    $postSession->start_time = $session->start_time;
    $postSession->end_time = $session->end_time;
    $postSession->responsible_user_id = Auth::id();
    $postSession->original_session_id = $session->id;
    $postSession->save();

    // Attach attendees based on the checkbox
    foreach ($session->users as $user) {
        if ($request->has("attendees.{$user->id}")) {
            $postSession->users()->attach($user->id);
        }
    }

    return redirect()->route('user.responsible_sessions') // Assuming the route name for responsible sessions is 'user.responsible_sessions'
        ->with('success', 'Post-training session created successfully.');
}



}
