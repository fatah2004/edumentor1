<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\User;
use App\Models\PostTrainingSession;

class AdminFeedbackController extends Controller
{
    public function index(Request $request)
    {
        $query = Feedback::query();

        // Filter by user name
        if ($request->has('user_name')) {
            $query->whereHas('user', function ($subquery) use ($request) {
                $subquery->where('name', 'like', '%' . $request->user_name . '%');
            });
        }

        // Filter by post training session name
        if ($request->has('session_name')) {
            $query->whereHas('postTrainingSession', function ($subquery) use ($request) {
                $subquery->where('title', 'like', '%' . $request->session_name . '%');
            });
        }

        // Fetch all feedback records based on the applied filters
        $feedback = $query->get();

        // Pass the feedback data to the view
        return view('feedback.adminindex', compact('feedback'));
    }
}
