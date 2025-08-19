<?php

namespace Database\Seeders;

use App\Models\Paddy;
use Illuminate\Database\Seeder;

class PaddySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paddy::factory(50)->create();
    }
}