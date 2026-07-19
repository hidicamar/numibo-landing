<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Str::title(fake()->words(2, true)),
            'type' => fake()->unique()->slug(2),
            'content' => fake()->paragraphs(3, true),
            'lang' => fake()->randomElement(['sl', 'en', 'de', 'bs']),
        ];
    }
}
