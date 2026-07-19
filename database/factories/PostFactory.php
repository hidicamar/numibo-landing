<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
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
        return [
            'post_category_id' => PostCategory::factory(),
            'title' => fake()->unique()->sentence(),
            'subtitle' => fake()->sentence(),
            'summary' => fake()->paragraph(),
            'content' => fake()->paragraphs(4, true),
            'lang' => fake()->randomElement(['sl', 'en', 'de', 'bs']),
            'published_at' => now(),
        ];
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes): array => [
            'published_at' => now()->addWeek(),
        ]);
    }
}
