<?php

namespace Database\Seeders;

use App\Models\Drying;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DryingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Drying::factory(50)->create();
    }
}