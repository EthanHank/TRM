<?php

namespace App\Services;

use App\Models\Milling;
use App\Models\Result;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
                    'appointment_type',
                ])->withTrashed();
            },
        ]);
    }

    public function createMilling($appointment)
    {
        $milling = Milling::create([
            'appointment_id' => $appointment->id,
            'milling_start_date' => now(),
            'milling_end_date' => null, // Set to null initially
            'bag_quantity' => $appointment->bag_quantity, // Assuming bag_quantity is part of the appointment
            'status' => 'In Progress',
        ]);

        $appointment->status = 'Milling';
        $appointment->save();

        return $milling;
    }

    public function updateMilling(Milling $milling, array $data): bool
    {
        try {
            DB::beginTransaction();

            foreach ($data['results'] as $result_type_id => $bag_quantity) {
                Result::create([
                    'result_type_id' => $result_type_id,
                    'milling_id' => $milling->id,
                    'user_id' => $milling->appointment->paddy->user_id,
                    'bag_quantity' => $bag_quantity,
                ]);
            }

            $milling->status = 'Completed';
            $milling->milling_end_date = now();
            $milling->save();

            // Update the appointment status to 'Completed'
            $milling->appointment->status = 'Milled';
            $milling->appointment->save();

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update milling: '.$e->getMessage());

            return false;
        }
    }
}
