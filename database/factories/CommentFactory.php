<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'is_visible' => $this->faker->boolean,
            'user_id' => User::InRandomOrder()->first()->id,
            'commentable_id' => Post::InRandomOrder()->first()->id,
            'commentable_type' => 'App\Models\Post',
        ];
    }
}
