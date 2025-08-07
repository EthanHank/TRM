<?php

namespace Database\Seeders;

use App\Models\ResultType;
use Illuminate\Database\Seeder;

class ResultTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $result_types = [
            ['name' => 'white rice', 'description' => 'This is the main product of milling process. pure white rice'],
            ['name' => 'broken rice', 'description' => 'This is the broken rice product from milling process'],
            ['name' => 'bran', 'description' => 'This is the bran product from milling process'],
            ['name' => 'husk', 'description' => 'This is the husk product from milling process'],
        ];

        foreach ($result_types as $result_type) {
            ResultType::create($result_type);
        }
    }
}
