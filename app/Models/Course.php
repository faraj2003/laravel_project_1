<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'slug', 'is_published', 'price'];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * ACCESSOR: Calculates progress percentage for the logged-in user.
     * Use: $course->progress
     */
    public function getProgressAttribute()
    {
        $totalEpisodes = $this->episodes()->count();

        if ($totalEpisodes === 0) return 0;

        // Get count of episodes in THIS course that the AUTHENTICATED user has completed
        $completedCount = auth()->user()->episodes()
            ->where('course_id', $this->id)
            ->whereNotNull('completed_at')
            ->count();

        return round(($completedCount / $totalEpisodes) * 100);
    }
}