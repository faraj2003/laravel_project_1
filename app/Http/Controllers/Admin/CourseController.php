<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();

        return view('admin.courses.index', compact('courses'));
    }

    public function togglePublish(Course $course)
    {
        $course->is_published = ! $course->is_published;
        $course->save();

        return back()->with('success', 'Course status updated.');
    }
    
    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
    // 1️⃣ Validation
        $request->validate([
            'title' => 'required|unique:courses,title',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
        ]);

    // 2️⃣ Create Course
        Course::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => auth()->id(),
        ]);

    // 3️⃣ Redirect
        return redirect()
            ->route('admin.courses.index')
            ->with('success', 'Course created successfully!');
        }

    
}
