<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
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
            'type' => $this->faker->randomElement(['post', 'product', 'event']),
            'order_column' => $this->faker->numberBetween(0, 100),
        ];
    }
}
