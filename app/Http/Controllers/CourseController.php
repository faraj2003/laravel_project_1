<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Str;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('teacher')
            ->where('is_published', true)
            ->get();

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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

    /**
     * Display the specified resource.
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function togglePublish(Course $course)
    {
        $course->is_published = ! $course->is_published;
        $course->save();

        return back();
    }

}
