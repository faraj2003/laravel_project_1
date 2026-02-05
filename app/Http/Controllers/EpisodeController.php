<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Course;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

    Episode::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'content' => $request->content,
            'order' => $request->order ?? 0,
        ]);
        $course = Course::findOrFail($request->course_id);
        abort_if($course->user_id !== auth()->id(), 403);


    return redirect()->back()->with('success', 'Episode created successfully');
    }

    public function show(Episode $episode)
    {
        // Security: Ensure the user is allowed to view this episode
        // For now, if the course is published, anyone logged in can view.
        // If it's a draft, only the teacher can view.
        if (! $episode->course->is_published && $episode->course->user_id !== auth()->id()) {
            abort(403);
        }

        return view('episodes.show', compact('episode'));
    }

    public function create(Request $request) // 1. Inject Request
    {
        // 2. Fetch only the current user's courses for the dropdown
        $courses = Course::where('user_id', auth()->id())->get();

        // 3. Optional: If a course_id is passed in the URL (e.g. ?course_id=5), pre-select it.
        // We use 'find' instead of 'findOrFail' to avoid crashing if the ID is bad.
        $selectedCourse = null;
        if ($request->has('course_id')) {
            $selectedCourse = Course::find($request->course_id);
            
            // Security Check: Ensure the user owns this course
            if ($selectedCourse && $selectedCourse->user_id !== auth()->id()) {
                abort(403);
            }
        }

        return view('episodes.create', compact('courses', 'selectedCourse'));
    }


}
