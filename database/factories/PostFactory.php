<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->words(4, true);
        $slug = Str::slug($title);
        $creator = User::inRandomOrder()->first()->id;

        return [
            'title' => Str::ucfirst($title),
            'slug' => $slug,
            'excerpt' => fake()->paragraph(3),
            'content' => fake()->paragraphs(9, true),
            'published_at' => now(),
            'created_by' => $creator,
            'updated_by' => $creator,
            'published_by' => $creator,
        ];
    }
}
