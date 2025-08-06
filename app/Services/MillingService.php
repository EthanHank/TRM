<?php

namespace App\Services;

use App\Models\Milling;
use Carbon\Carbon;

class MillingService
{
    public function getAllMillings()
    {
        return Milling::with([
            'appointment' => function ($query) {
                $query->with([
                    'paddy' => function ($query) {
                        $query->withTrashed();
                    },
                    'paddy.paddy_type',
                    'appointment_type'
                ])->withTrashed();
            }
        ]);
    }

    public function createMilling($appointment)
    {
        $milling = Milling::create([
            'appointment_id' => $appointment->id,
            'milling_start_date' => Carbon::now(),
            'milling_end_date' => null, // Set to null initially
            'bag_quantity' => $appointment->bag_quantity, // Assuming bag_quantity is part of the appointment
            'status' => 'In Progress',
        ]);

        $appointment->status = "Milling";
        $appointment->save();

        return $milling;
    }
}