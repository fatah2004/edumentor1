<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\PostTrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        // Fetch feedbacks created by the authenticated user
        $feedback = Feedback::where('user_id', Auth::id())->get();
    
        // Find the first post training session that the user hasn't submitted feedback for
        $postTrainingSession = PostTrainingSession::whereDoesntHave('feedback', function ($query) {
            $query->where('user_id', Auth::id());
        })->first();
    
        // Pass the feedback data and postTrainingSession to the view
        return view('feedback.index', compact('feedback', 'postTrainingSession'));
    }
    public function create()
    {
        // Find the first post training session that the user hasn't submitted feedback for
        $sessionId = PostTrainingSession::whereDoesntHave('feedback', function ($query) {
            $query->where('user_id', Auth::id());
        })->value('id');

        if ($sessionId) {
            $postTrainingSession = PostTrainingSession::findOrFail($sessionId);
            return view('feedback.index', compact('postTrainingSession'));
        } else {
            // No pending sessions found, redirect back with a message
            return redirect()->back()->with('info', 'You have submitted feedback for all available sessions.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_training_session_id' => 'required|exists:post_training_sessions,id',
            'comment' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'post_training_session_id' => $request->post_training_session_id,
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return redirect()->route('feedback.index')->with('success', 'Feedback submitted successfully.');
    }
}
