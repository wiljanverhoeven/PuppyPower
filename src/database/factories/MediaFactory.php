<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
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
            'path' => $this->faker->url,
            'description' => $this->faker->paragraph,
            'module_id' => \App\Models\Module::factory(),
            'order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
