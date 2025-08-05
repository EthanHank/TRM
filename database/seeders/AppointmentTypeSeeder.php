<?php

namespace Database\Seeders;

use App\Models\AppointmentType;
use Illuminate\Database\Seeder;

class AppointmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apppointment_types = [
            ['name' => 'milling', 'description' => 'Milling appointment type'],
            ['name' => 'drying', 'description' => 'Drying appointment type'],
        ];

        foreach ($apppointment_types as $apppointment_type) {
            AppointmentType::create($apppointment_type);
        }
    }
}
