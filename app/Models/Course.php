<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Episode;
use Illuminate\Support\Str;



class Course extends Model
{
    protected $fillable = [
    'user_id',
    'title',
    'description',
    'slug',
    'is_published',
    'price',
];

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    protected static function boot()

    {
        parent::boot();
        static::creating(function ($course) {
            $course->slug = Str::slug($course->title);
        });
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
