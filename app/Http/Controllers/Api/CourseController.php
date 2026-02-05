<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        // 1. Fetch only published courses
        // 2. Load 'teacher' and 'episodes' to prevent N+1 performance issues
        $courses = Course::with(['teacher', 'episodes'])
            ->where('is_published', true)
            ->latest()
            ->get();

        // 3. Return as a Resource Collection
        // This automatically adds the { "data": [...] } wrapper required by the spec.
        return CourseResource::collection($courses);
    }
}