<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Phone>
 */
class PhoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phoneable_id' => User::InRandomOrder()->first()->id,
            'phoneable_type' => User::class,
            'country_code' => $this->faker->optional()->numerify('+##'),
            'number' => $this->faker->unique()->phoneNumber,
            'type' => $this->faker->randomElement(['mobile', 'home', 'work']),
            'verified_at' => $this->faker->optional()->dateTime,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
