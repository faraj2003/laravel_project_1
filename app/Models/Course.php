<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- This line is crucial!
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'price',
        'thumbnail',
        'is_published',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}