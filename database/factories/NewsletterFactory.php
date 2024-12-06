<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Newsletter>
 */
class NewsletterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'subscribed_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'unsubscribed_at' => $this->faker->optional()->dateTimeBetween('-1 year', 'now'),
            'is_subscribed' => $this->faker->boolean(90),
        ];
    }
}
