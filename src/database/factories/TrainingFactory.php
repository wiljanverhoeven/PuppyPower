<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Training>
 */
class TrainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $methods = [
            ['name' => 'Basic Obedience', 'type' => 'Online'],
            ['name' => 'Advanced Tricks', 'type' => 'Online'],
            ['name' => 'Behavioral Training', 'type' => 'Live'],
        ];

        $method = $this->faker->randomElement($methods);

        return [
            'name' => $method['name'],
            'description' => $this->faker->sentence(),
            'date' => $this->faker->date(),
            'type' => $method['type'],
            'price' => $this->faker->randomFloat(2, 50, 200),
        ];
    }
}
