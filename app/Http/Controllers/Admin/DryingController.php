<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AppointmentService;
use App\Services\DryingService;

class DryingController extends Controller
{
    public function index(AppointmentService $appointmentService, DryingService $dryingService)
    {
        $appointments = $appointmentService->confirmedAppointmentList()
            ->whereHas('appointment_type', function ($query) {
                $query->where('name', 'drying');
            })
            ->orderBy('appointment_start_date', 'asc')
            ->paginate(10)->withQueryString();

        $completed_dryings = $dryingService->getAllDryings()
            ->where('status', '=', 'Completed')
            ->orderBy('milling_start_date', 'asc')
            ->paginate(10)->withQueryString();

        $progress_dryings = $dryingService->getAllDryings()
            ->where('status', '=', 'In Progress')
            ->get();

        return view('admin.dryings.index', compact('appointments', 'completed_dryings', 'progress_dryings'));
    }
}
