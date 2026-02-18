<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder; // Don't forget this import!
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    // Notice we included 'content' here so it can be saved to the database!
    protected $fillable = [
        'course_id',
        'title',
        'video_path',
        'duration',
        'order',
        'content'
    ];

    /**
     * The "booted" method of the model.
     * This Global Scope ensures Episodes are ALWAYS fetched in the correct order.
     */
    protected static function booted(): void
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order', 'asc');
        });
    }

    /**
     * Get the course that owns the episode.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}