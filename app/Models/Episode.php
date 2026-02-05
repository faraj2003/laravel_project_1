<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;


class Episode extends Model
{

    protected $fillable = [
    'course_id',
    'title',
    'content',
    'order',
];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
