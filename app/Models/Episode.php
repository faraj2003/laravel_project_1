<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- Import this here too
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title', 'content', 'order'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}