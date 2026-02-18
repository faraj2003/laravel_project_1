<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    /**
     * Determine whether the user can view the course content (episodes).
     */
    public function view(User $user, Course $course): bool
    {
        // Rule: User must be enrolled in the course to watch episodes
        return $user->courses->contains($course->id);
    }
}