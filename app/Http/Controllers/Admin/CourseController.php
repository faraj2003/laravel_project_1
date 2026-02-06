<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    // UPDATED: Now uses StoreCourseRequest
    public function store(StoreCourseRequest $request)
    {
        // 1. Initialize path as null
        $path = null;

        // 2. Check if image was uploaded before trying to store it
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        // 3. Create Course
        $course = Course::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'thumbnail' => $path, // This will be null if no image is uploaded
        ]);

        Log::info("Course Created: ID {$course->id} - {$course->title} by User " . auth()->id());

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully!');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    // UPDATED: Now uses UpdateCourseRequest
    public function update(UpdateCourseRequest $request, Course $course)
    {
        // 1. Validation is auto-handled by the Request class now.

        $data = $request->only(['title', 'description', 'price']);
        $data['slug'] = Str::slug($request->title);

        // 2. Handle Image Update
        if ($request->hasFile('thumbnail')) {
            // Delete old image if exists
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $course->update($data);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated.');
    }

    public function destroy(Course $course)
    {
        // Delete image file
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }
        
        $course->delete();
        return back()->with('success', 'Course deleted.');
    }

    public function togglePublish(Course $course)
    {
        $course->is_published = ! $course->is_published;
        $course->save();
        return back()->with('success', 'Publish status updated.');
    }
}