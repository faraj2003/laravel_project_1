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
        $episodes = $course->episodes()->orderBy('order', 'asc')->get();
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
            'video_file' => 'nullable|file|mimes:mp4,mov,ogg|max:512000', // 500MB Max
            'video_url' => 'nullable|url',
            'duration' => 'nullable|numeric',
            'content' => 'nullable|string',
        ]);

        // Logic: Must have either a file OR a link
        if (!$request->hasFile('video_file') && !$request->filled('video_url')) {
            return back()->withErrors(['video_file' => 'Please provide either a video file or a link.'])->withInput();
        }

        $path = null;
        if ($request->hasFile('video_file')) {
            $path = $request->file('video_file')->store('course-content/' . $course->id, 'public');
        }

        $currentMaxOrder = $course->episodes()->max('order') ?? 0;

        $course->episodes()->create([
            'title' => $request->title,
            'video_path' => $path,
            'video_url' => $request->video_url, // Added support for links
            'duration' => $request->duration ? (int)($request->duration * 60) : 0,
            'order' => $currentMaxOrder + 1,
            'content' => $request->content, 
        ]);

        return redirect()->route('admin.courses.episodes.index', $course)->with('success', 'Module initialized successfully.');
    }

    public function edit(Course $course, Episode $episode)
    {
        return view('admin.episodes.edit', compact('course', 'episode'));
    }

    public function update(Request $request, Course $course, Episode $episode)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_file' => 'nullable|file|mimes:mp4,mov,ogg|max:512000',
            'video_url' => 'nullable|url',
            'duration' => 'nullable|numeric',
            'content' => 'nullable|string',
        ]);

        $data = [
            'title' => $request->title,
            'video_url' => $request->video_url,
            'duration' => $request->filled('duration') ? (int)($request->duration * 60) : $episode->duration,
            'content' => $request->content,
        ];

        if ($request->hasFile('video_file')) {
            if ($episode->video_path) {
                Storage::disk('public')->delete($episode->video_path);
            }
            $data['video_path'] = $request->file('video_file')->store('course-content/' . $course->id, 'public');
        }

        $episode->update($data);

        return redirect()->route('admin.courses.episodes.index', $course)->with('success', 'Module data updated.');
    }

    public function destroy(Course $course, Episode $episode)
    {
        if ($episode->video_path) {
            Storage::disk('public')->delete($episode->video_path);
        }
        $episode->delete();
        return redirect()->route('admin.courses.episodes.index', $course)->with('success', 'Module removed.');
    }
}