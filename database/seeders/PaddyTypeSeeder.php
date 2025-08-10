<?php

namespace Database\Seeders;

use App\Models\PaddyType;
use Illuminate\Database\Seeder;

class PaddyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paddy_types = [
            ['name' => 'Moe', 'description' => 'High quality paddy'],
            ['name' => 'Nway', 'description' => 'High quality paddy'],
        ];

        foreach ($paddy_types as $type) {
            PaddyType::updateOrCreate(
                ['name' => $type['name']],
                ['description' => $type['description']]
            );
        }
    }
}
