<?php

namespace Database\Factories;

use App\Models\AppointmentType;
use App\Models\Paddy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'paddy_id' => Paddy::inRandomOrder()->first()->id,
            'appointment_type_id' => AppointmentType::inRandomOrder()->first()->id,
            'appointment_start_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'appointment_end_date' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'bag_quantity' => $this->faker->numberBetween(50, 200),
            'duration' => $this->faker->numberBetween(1, 5),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'completed', 'cancelled']),
        ];
    }
}