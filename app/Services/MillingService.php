<?php

namespace App\Services;

use App\Models\Milling;
use Carbon\Carbon;

class MillingService
{
    public function getAllMillings()
    {
        return Milling::select('id', 'appointment_id', 'milling_start_date', 'milling_end_date','bag_quantity', 'status')
            ->with(['appointment.paddy.paddy_type:name', 'appointment.appointment_type:name']);
    }
}