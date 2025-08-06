<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Milling\MakeMillRequest;
use App\Services\AppointmentService;
use App\Services\MillingService;
use App\Models\Appointment;

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

        return view('admin.millings.index', compact('appointments', 'completed_millings', 'progress_millings'));
    }

    public function create(Appointment $appointment)
    {
        return view('admin.millings.create', compact('appointment'));
    }

    public function store(MakeMillRequest $request, MillingService $millingService)
    {
        $data = $request->validated();
        $appointment = Appointment::findOrFail($data['appointment_id']);
        $milling = $millingService->createMilling($appointment);

        if ($milling) {
            return redirect()->route('admin.millings.index')->with('success', 'Milling created successfully.');
        }

        return redirect()->back()->with('error', 'Failed to create milling.');
    }

}
