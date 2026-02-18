<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EpisodeController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display the specified episode only to enrolled students.
     */
    public function show(Episode $episode)
    {
        // Check if the user is enrolled in the course first
        $this->authorize('view', $episode->course);

        return view('episodes.show', compact('episode'));
    }

    /**
     * Mark the episode as completed for the authenticated user.
     */
    public function complete(Episode $episode)
    {
        // 1. Get the logged-in user
        $user = auth()->user();

        // 2. The magic method: syncWithoutDetaching
        // It links the user and episode and adds the current time to 'completed_at'
        $user->episodes()->syncWithoutDetaching([
            $episode->id => ['completed_at' => now()]
        ]);

        return back()->with('success', 'Lesson marked as complete! Keep going! 🚀');
    }
}