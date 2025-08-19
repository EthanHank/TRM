<?php

namespace Database\Seeders;

use App\Models\MillingResultCalculation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MillingResultCalculationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MillingResultCalculation::factory(50)->create();
    }
}