<?php

namespace Database\Factories;

use App\Models\Milling;
use App\Models\ResultType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'milling_id' => Milling::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'result_type_id' => ResultType::inRandomOrder()->first()->id,
            'bag_quantity' => $this->faker->numberBetween(10, 100),
        ];
    }
}