<?php

namespace Database\Factories;

use App\Models\Paddy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MillingResultCalculation>
 */
class MillingResultCalculationFactory extends Factory
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
            'initial_moisture_content' => $this->faker->randomFloat(2, 15, 25),
            'final_moisture_content' => $this->faker->randomFloat(2, 10, 14),
            'initial_bag_quantity' => $this->faker->numberBetween(100, 500),
            'adjusted_weight' => $this->faker->numberBetween(2000, 12000),
            'white_rice_bags' => $this->faker->numberBetween(50, 300),
            'broken_rice_bags' => $this->faker->numberBetween(10, 50),
            'bran_bags' => $this->faker->numberBetween(5, 20),
            'husk_bags' => $this->faker->numberBetween(20, 100),
        ];
    }
}