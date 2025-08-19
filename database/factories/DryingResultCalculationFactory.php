<?php

namespace Database\Factories;

use App\Models\Paddy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DryingResultCalculation>
 */
class DryingResultCalculationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $initial_total_bag_weight = $this->faker->numberBetween(2500, 12500);
        $final_total_bag_weight = $this->faker->numberBetween(2000, $initial_total_bag_weight);

        return [
            'paddy_id' => Paddy::inRandomOrder()->first()->id,
            'initial_moisture_content' => $this->faker->randomFloat(2, 15, 25),
            'final_moisture_content' => $this->faker->randomFloat(2, 10, 14),
            'initial_bag_quantity' => $this->faker->numberBetween(100, 500),
            'final_bag_quantity' => $this->faker->numberBetween(80, 480),
            'initial_total_bag_weight' => $initial_total_bag_weight,
            'final_total_bag_weight' => $final_total_bag_weight,
            'approximate_loss' => $initial_total_bag_weight - $final_total_bag_weight,
        ];
    }
}