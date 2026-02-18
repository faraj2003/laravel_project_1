<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class EpisodeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'title' => $this->faker->sentence(3),
            'video_path' => null, // We keep this null or a placeholder string
            'duration' => $this->faker->numberBetween(300, 1800), // 5 to 30 mins in seconds
            'order' => 1, // We will override this in the seeder
            'content' => $this->faker->paragraphs(2, true),
        ];
    }
}