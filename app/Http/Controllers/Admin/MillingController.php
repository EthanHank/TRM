<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Milling;
use App\Services\AppointmentService;
use App\Services\MillingService;

class MillingController extends Controller
{
    public function index(AppointmentService $appointmentService, MillingService $millingService)
    {
        $appointments = $appointmentService->confirmedAppointmentList()
        ->whereHas('appointment_type', function ($query) {
            $query->where('name', 'milling');
        })
        ->orderBy('appointment_start_date', 'asc')
        ->paginate(10)->withQueryString();

        $completed_millings = $millingService->getAllMillings()
            ->where('status', '=', 'Completed')
            ->orderBy('milling_start_date', 'asc')
            ->paginate(10)->withQueryString();
        
        $progress_millings = $millingService->getAllMillings()
            ->where('status', '=', 'In Progress')
            ->get();

        return view('admin.milling.index', compact('completed_millings', 'progress_millings', 'appointments'));
    }

}
