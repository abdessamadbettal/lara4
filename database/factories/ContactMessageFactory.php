<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactMessage>
 */
class ContactMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'message' => $this->faker->paragraph,
            'subject' => $this->faker->sentence,
            'phone' => $this->faker->phoneNumber,
            'is_read' => $this->faker->boolean,
            'ip_address' => $this->faker->ipv4,
            'user_agent' => $this->faker->userAgent,
            'locale' => $this->faker->locale,
            'user_id' => $this->faker->optional()->randomElement(User::pluck('id')),
        ];
    }
}
