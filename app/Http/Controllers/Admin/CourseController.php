<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
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

    public function store(StoreCourseRequest $request)
    {
        $path = null;

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $course = Course::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price ?? 0, // Fallback safely to 0
            'category' => $request->category, 
            'is_published' => $request->has('is_published'),
            'thumbnail' => $path, 
        ]);

        Log::info("Course Created: ID {$course->id} - {$course->title} by User " . auth()->id());

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully!');
    }

    public function edit(Course $course)
    {
        // Fetch students and load enrolled ones for the Access Control box
        $students = User::where('role', 'student')->get();
        $course->load('students');

        return view('admin.courses.edit', compact('course', 'students'));
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = $request->only(['title', 'description', 'price', 'category']);
        $data['slug'] = Str::slug($request->title);
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('thumbnail')) {
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

    // --- NEW ENROLLMENT METHODS --- //
    
    public function enrollStudent(Request $request, Course $course)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);
        $course->students()->syncWithoutDetaching([$request->user_id]);
        
        return back()->with('success', 'Student access granted successfully.');
    }

    public function removeStudent(Request $request, Course $course)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);
        $course->students()->detach($request->user_id);
        
        return back()->with('success', 'Student access revoked.');
    }
}