<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'user_id' => mt_rand(1,5),
            'category_id' => mt_rand(1,3),
            'title' => $this->faker->sentence(mt_rand(1,2)),
            'slug' => $this->faker->slug(),
            'writer' => $this->faker->name(),
            'author' => $this->faker->name(),
            'publisher' => $this->faker->name(),
            'image' => null,
            'excerpt' => $this->faker->paragraph(),
            'body' => collect($this->faker->paragraphs(mt_rand(1,8)))
                    ->map(fn($p) => "<p>$p</p>")->implode(''),
            'publication_year' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
