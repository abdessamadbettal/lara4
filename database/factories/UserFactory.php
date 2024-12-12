<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now()->subDays(rand(0, 365))->format('Y-m-d H:i:s'),
            'updated_at' => now()->subDays(rand(0, 365))->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

        /**
     * Configure the factory.
     */
    public function configure()
    {
        return $this->afterCreating(function (User $user) {

            // Assign a random role to the user
            $roles = Role::all()->pluck('name')->toArray();
            $randomRole = $roles[array_rand($roles)];
            $user->assignRole($randomRole);

            // Get all images from the specified directory
            $clientImages = File::glob(storage_path('app/images/users/*.{jpg,jpeg,png,gif}'), GLOB_BRACE);

            // Ensure there are images in the directory
            if (count($clientImages) > 0) {
                // Randomly select one image
                $selectedImage = $clientImages[array_rand($clientImages)];

                // Create the temporary directory if it doesn't exist
                $tempDir = storage_path('app/temp');
                if (!File::exists($tempDir)) {
                    File::makeDirectory($tempDir, 0755, true);
                }

                // Copy the selected image to the temporary directory
                $tempImagePath = $tempDir . '/' . basename($selectedImage);
                File::copy($selectedImage, $tempImagePath);

                // Attach the image to the 'avatar' collection
                $user->addMedia($tempImagePath)
                     ->toMediaCollection('avatar');
            }
        });
    }
}
