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
        $name = [
            'en' => $this->faker->sentence,
            'fr' => $this->faker->sentence,
            'es' => $this->faker->sentence,
        ];


        $content = <<<EOD
        # Full Stack Developer
        Ea enim **dolorem** qui quam velit maiores. [Accusamus](https://https://github.com/abdessamadbettal) maxime ut alias omnis qui at aut. Eligendi est qui quo tenetur atque est ~~placeat~~. Quia expedita cum *voluptatibus* alias ut.
        **Lorem ipsum dolor sit amet, consectetur adipiscing elit**,
        1. sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
        2. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
        3. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        * Full Stack Developer with Expertise in PHP and Laravel
        ![](http://localhost/storage/1.jpg)
        Lorem ipsum dolor sit amet,
        consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate ```
        velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
        sunt in culpa qui officia deserunt mollit anim id est laborum```
        > Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        EOD;

        return [
            'name' => $name,
            'content' => [
                'en' => $content,
                'fr' => $content,
                'es' => $content,
            ],
            'author_id' => \App\Models\User::InRandomOrder()->first()->id,
            'category_id' => \App\Models\Category::InRandomOrder()->first()->id,
            'is_published' => $this->faker->boolean,
            'time_to_read' => $this->faker->numberBetween(1, 60),
        ];;
    }
}
