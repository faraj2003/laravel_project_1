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

    public function create()
    {
        $courses = Course::all();
        $course = Course::findOrFail($request->course_id);
        abort_if($course->user_id !== auth()->id(), 403);

        return view('episodes.create', compact('courses'));

    }


}
