<?php

namespace App\Services;

use App\Models\Drying;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\PaddyService;

class DryingService
{
    private PaddyService $paddyService;

    public function __construct(PaddyService $paddyService) 
    {
        $this->paddyService = $paddyService;
    }
    public function getAllDryings()
    {
        return Drying::with([
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

    public function createDrying($appointment)
    {
        $drying = Drying::create([
            'appointment_id' => $appointment->id,
            'drying_start_date' => Carbon::now(),
            'drying_end_date' => null, // Set to null initially
            'bag_quantity' => $appointment->bag_quantity, // Assuming bag_quantity is part of the appointment
            'status' => 'In Progress',
        ]);

        $appointment->status = 'Drying';
        $appointment->save();

        return $drying;
    }

    public function updateDrying($drying, $data)
    {
        try {
            DB::beginTransaction();

            $paddy = $drying->appointment->paddy;

            $paddy->restore();

            $storageData = $this->paddyService->getStorageData($paddy, 14);

            $paddy->bag_quantity = $data['bag_quantity'];
            $paddy->bag_weight = $data['bag_weight'];
            $paddy->total_bag_weight = $paddy->bag_quantity * $paddy->bag_weight;
            $paddy->moisture_content = 14;
            $paddy->storage_start_date = $storageData['storage_start_date'];
            $paddy->storage_end_date = $storageData['storage_end_date'];
            $paddy->maximum_storage_duration = $storageData['maximum_storage_duration'];
            $paddy->save();
            

            $drying->status = 'Completed';
            $drying->drying_end_date = now();
            $drying->save();

            // Update the appointment status to 'Completed'
            $drying->appointment->status = 'Dried';
            $drying->appointment->save();

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update milling: '.$e->getMessage());

            return false;
        }
    }
}
