<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EpisodeController extends Controller
{
    public function index(Course $course)
    {
        $episodes = $course->episodes()->orderBy('created_at', 'asc')->get();
        return view('admin.episodes.index', compact('course', 'episodes'));
    }

    public function create(Course $course)
    {
        return view('admin.episodes.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url', // Assuming video URL for now, can be file upload
            'duration' => 'nullable|string',
        ]);

        $course->episodes()->create($request->all());

        return redirect()->route('admin.courses.episodes.index', $course)
            ->with('success', 'Episode created successfully.');
    }

    public function edit(Course $course, Episode $episode)
    {
        return view('admin.episodes.edit', compact('course', 'episode'));
    }

    public function update(Request $request, Course $course, Episode $episode)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'nullable|url',
            'duration' => 'nullable|string',
        ]);

        $episode->update($request->all());

        return redirect()->route('admin.courses.episodes.index', $course)
            ->with('success', 'Episode updated successfully.');
    }

    public function destroy(Course $course, Episode $episode)
    {
        $episode->delete();

        return redirect()->route('admin.courses.episodes.index', $course)
            ->with('success', 'Episode deleted successfully.');
    }
}