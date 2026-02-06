<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Episode;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create the specific Admin User (Required for evaluation)
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@laralearn.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        // 2. Create 5 Random Students
        User::factory(5)->create([
            'role' => 'student',
        ]);

        // 3. Create 10 Courses assigned to the Admin
        Course::factory(10)->create([
            'user_id' => $admin->id,
        ])->each(function ($course) {
            
            // 4. Create 3 to 5 Episodes for each Course
            Episode::factory(rand(3, 5))->create([
                'course_id' => $course->id,
            ]);

            // Optional: Re-number episodes sequentially (1, 2, 3...)
            $i = 1;
            foreach($course->episodes->sortBy('id') as $episode) {
                $episode->update(['order' => $i++]);
            }
        });
    }
}