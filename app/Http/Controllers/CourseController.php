<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of all published courses (Public Catalog).
     */
    public function index()
    {
        $courses = Course::with('teacher')
            ->where('is_published', true)
            ->paginate(12);

        return view('courses.index', compact('courses'));
    }

    /**
     * Display the user's personal dashboard (Enrolled Courses).
     */
    public function dashboard()
    {
        // Fetch only courses the logged-in user is enrolled in
        $courses = auth()->user()->courses()->with('teacher')->get();

        return view('dashboard', compact('courses'));
    }

    /**
     * Enroll the user in a course.
     */
    public function enroll(Course $course)
    {
        // Sync without detaching ensures we don't accidentally un-enroll them or enroll twice
        $course->students()->syncWithoutDetaching([auth()->id()]);

        // Redirect back to the Course page, NOT the dashboard!
        return redirect()->route('courses.show', $course)
                         ->with('success', 'You have successfully enrolled! You can now access all modules.');
    }

    /**
     * Show the course details.
     */
    public function show(Course $course)
    {
        if (! $course->is_published && auth()->id() !== $course->user_id) {
            abort(403);
        }
        $course->load('episodes');
        return view('courses.show', compact('course'));
    }

    /**
     * Store a newly created course.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $course = Course::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'slug' => Str::slug($request->title),
        ]);
        return redirect()->route('courses.show', $course);
    }

    public function togglePublish(Course $course)
    {
        $course->is_published = ! $course->is_published;
        $course->save();

        return back();
    }
}