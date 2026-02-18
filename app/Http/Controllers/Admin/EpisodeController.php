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
        // Orders by 'order' column so episodes appear in correct sequence
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
            'video_file' => 'required|file|mimes:mp4,mov,ogg|max:512000', // 500MB Max
            'duration' => 'nullable|numeric', // 'numeric' allows decimals (e.g. 5.5 minutes)
            'content' => 'nullable|string', // NEW: Validate the description
        ]);

        $path = null;
        if ($request->hasFile('video_file')) {
            // Stores in: storage/app/public/course-content/{id}
            $path = $request->file('video_file')->store('course-content/' . $course->id, 'public');
        }

        // Safely get the current max order, default to 0 if it's the very first episode
        $currentMaxOrder = $course->episodes()->max('order') ?? 0;

        $course->episodes()->create([
            'title' => $request->title,
            'video_path' => $path,
            // Convert Minutes (Input) to Seconds (Database)
            'duration' => $request->duration ? (int)($request->duration * 60) : 0,
            'order' => $currentMaxOrder + 1,
            'content' => $request->content, // NEW: Save the description to the database
        ]);

        return redirect()->route('admin.courses.episodes.index', $course)
            ->with('success', 'Episode uploaded successfully.');
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
            'duration' => 'nullable|numeric',
            'content' => 'nullable|string', // NEW: Validate the description
        ]);

        $data = [
            'title' => $request->title,
            // Update duration if provided, otherwise keep old value
            'duration' => $request->filled('duration') ? (int)($request->duration * 60) : $episode->duration,
            'content' => $request->content, // NEW: Update the description in the database
        ];

        if ($request->hasFile('video_file')) {
            // 1. Delete old video from storage to save space
            if ($episode->video_path) {
                Storage::disk('public')->delete($episode->video_path);
            }
            // 2. Store new video
            $data['video_path'] = $request->file('video_file')->store('course-content/' . $course->id, 'public');
        }

        $episode->update($data);

        return redirect()->route('admin.courses.episodes.index', $course)
            ->with('success', 'Episode updated successfully.');
    }

    public function destroy(Course $course, Episode $episode)
    {
        // Clean up the physical file when an episode is deleted
        if ($episode->video_path) {
            Storage::disk('public')->delete($episode->video_path);
        }
        
        $episode->delete();

        return redirect()->route('admin.courses.episodes.index', $course)
            ->with('success', 'Episode deleted successfully.');
    }
}