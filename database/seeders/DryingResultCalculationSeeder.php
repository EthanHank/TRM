<?php

namespace Database\Seeders;

use App\Models\DryingResultCalculation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DryingResultCalculationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DryingResultCalculation::factory(50)->create();
    }
}