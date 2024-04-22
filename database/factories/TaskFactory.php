<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => substr($this->faker->sentence(3), 0, 30),
            'description' => $this->faker->text(200),
            'expirationDate' => $this->faker->dateTimeBetween('2024-04-25', '2024-07-25')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
            'user_id' => 1,
            'category_id' => '',
            'related_id' => null  // Supondo que inicialmente não há relacionamentos
        ];
    }
}
