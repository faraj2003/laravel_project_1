<?php

namespace Database\Factories;

use App\Models\Admin; // Assuming admins create courses, or use User
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(4);
        return [
            'user_id' => User::factory(), // Creates a teacher for the course
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph(3),
            'is_published' => true,
            'price' => $this->faker->randomFloat(2, 10, 100),
        ];
    }
}