<?php

namespace App\Services;

use App\Models\Drying;

class DryingService
{
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
}
