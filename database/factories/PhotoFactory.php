<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'gallery_id' => Gallery::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'file_path' => 'https://picsum.photos/seed/' . rand(1, 1000) . '/1280/720',
        ];
    }
}