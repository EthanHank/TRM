<?php

namespace Database\Factories;

use App\Models\PaddyType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paddy>
 */
class PaddyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bag_quantity = $this->faker->numberBetween(100, 500);
        $bag_weight = $this->faker->randomElement([25, 50]);

        return [
            'user_id' => User::role('merchant')->inRandomOrder()->first()->id,
            'paddy_type_id' => PaddyType::inRandomOrder()->first()->id,
            'bag_quantity' => $bag_quantity,
            'bag_weight' => $bag_weight,
            'total_bag_weight' => $bag_quantity * $bag_weight,
            'moisture_content' => $this->faker->randomFloat(2, 12, 20),
            'storage_start_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'storage_end_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'maximum_storage_duration' => $this->faker->numberBetween(30, 90),
        ];
    }
}