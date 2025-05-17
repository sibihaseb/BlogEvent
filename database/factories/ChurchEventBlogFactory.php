<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChurchEventBlog>
 */
class ChurchEventBlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'type' => $this->faker->randomElement(['event', 'blog']), // adjust as needed
            'description' => $this->faker->paragraph(),
            'image' => 'uploads/default.jpg',
        ];
    }
}
