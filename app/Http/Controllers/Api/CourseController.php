<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of all courses (Fast & Light).
     */
    public function index()
    {
        // We only load the teacher here. 
        // Episodes are NOT loaded, so they won't appear in the JSON.
        $courses = Course::with('teacher')->where('is_published', true)->get();
        
        return CourseResource::collection($courses);
    }

    /**
     * Display a single course with its Syllabus (Detailed).
     */
    public function show(Course $course)
    {
        // EAGER LOADING: We tell Laravel to grab the episodes now.
        // This triggers the 'whenLoaded' check in the Resource.
        $course->load(['teacher', 'episodes']);
        
        return new CourseResource($course);
    }
}