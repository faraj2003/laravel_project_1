<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence;
        
        return [
            // We will override this in the seeder to assign it to the Admin
            'user_id' => User::factory(), 
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 0, 100),
            // Randomly publish some courses, keep others as drafts
            'is_published' => $this->faker->boolean(70), 
            'thumbnail' => null,
        ];
    }
}