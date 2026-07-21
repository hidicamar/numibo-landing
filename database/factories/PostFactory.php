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
            'title' => fake()->unique()->sentence(),
            'subtitle' => fake()->sentence(),
            'summary' => fake()->paragraph(),
            'content' => fake()->paragraphs(4, true),
            'lang' => fake()->randomElement(['sl', 'en', 'de', 'hr']),
            // The category must share the post's lang: PostCategory's
            // LanguageScope would otherwise resolve $post->category to null.
            'post_category_id' => fn (array $attributes) => PostCategory::factory()->create(['lang' => $attributes['lang']]),
            'published_at' => now(),
        ];
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes): array => [
            'published_at' => now()->addWeek(),
        ]);
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Post $post): void {
            $post->seo()->create([
                'title' => $post->title,
                'description' => $post->summary,
            ]);
        });
    }
}
