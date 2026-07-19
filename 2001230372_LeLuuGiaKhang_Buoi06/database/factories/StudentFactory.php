<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            "class_name" => fake()->randomElement(['12A1', '12A2', '12A3', '12A4']),
            'email' => fake()->unique()->safeEmail(),
            'age' => fake()->numberBetween(16, 25),
            'gender' => fake()->randomElement(['male', 'female']),
        ];
    }
}
