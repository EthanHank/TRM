<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Drying>
 */
class DryingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::inRandomOrder()->first()->id,
            'drying_start_date' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'drying_end_date' => $this->faker->dateTimeBetween('now', '+1 week'),
            'bag_quantity' => $this->faker->numberBetween(50, 200),
            'status' => $this->faker->randomElement(['in_progress', 'completed']),
        ];
    }
}