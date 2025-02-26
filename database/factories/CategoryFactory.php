<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => [
                'en' => $this->faker->word,
                'fr' => $this->faker->word,
                'es' => $this->faker->word
            ],
            'description' => [
                'en' => $this->faker->sentence,
                'fr' => $this->faker->sentence,
                'es' => $this->faker->sentence
            ],
            'parent_id' => null,
            'order_column' => $this->faker->numberBetween(0, 100),
            'is_active' => $this->faker->boolean,
            'deleted_at' => null,
        ];
    }
}
