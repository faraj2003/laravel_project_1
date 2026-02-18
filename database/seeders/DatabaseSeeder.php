<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Episode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Admins
        Admin::create([
            'name' => 'Faraj Admin',
            'email' => 'admin@laralearn.com',
            'password' => Hash::make('admin123'),
        ]);

        // 2. Create your Student Account
        $student = User::factory()->create([
            'name' => 'Faraj Student',
            'email' => 'student@laralearn.com',
            'password' => Hash::make('student123'),
        ]);

        // 3. Create 5 Courses, each with a Teacher and 5 Episodes
        Course::factory(5)->create()->each(function ($course) use ($student) {
            
            // Add 5 Episodes to each course
            for ($i = 1; $i <= 5; $i++) {
                Episode::factory()->create([
                    'course_id' => $course->id,
                    'order' => $i,
                    'title' => "Lesson $i: " . fake()->sentence(3),
                ]);
            }

            // AUTO-ENROLL you (the student) in these courses so you see them on your dashboard
            $course->students()->attach($student->id);
        });

        // 4. Create some random users who aren't enrolled anywhere
        User::factory(5)->create();
    }
}